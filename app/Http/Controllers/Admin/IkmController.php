<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\ResponseDetail;
use App\Models\Response;
use App\Models\Feedback;


class IkmController extends Controller
{
    public function index()
    {
        $surveyId = request('survey_id');
        $semuaSurvey = Survey::all();

        $surveyTerpilih = $this->ambilSurveyDenganPertanyaan($surveyId);
        $bobotNilaiTetimbang = $this->hitungBobotNilaiTetimbang($surveyTerpilih);

        $dataUnsur = $this->prosesUnsur($surveyTerpilih, $bobotNilaiTetimbang);

        $ikm = $this->menghitungIkm($dataUnsur['tetimbangPerUnsur']);
        $rating = $this->determineRating($ikm);

        $likertCounts = $this->hitungLikertCounts($surveyTerpilih);
        $jumlahPertanyaan = $surveyTerpilih->sum(fn($survey) => $survey->questions->count());
        $jumlahJawaban = ResponseDetail::whereIn('question_id', $surveyTerpilih->flatMap(fn($survey) => $survey->questions->pluck('id')))->count();
        $jumlahResponden = Response::whereIn('survey_id', $surveyTerpilih->pluck('id'))->distinct('respondent_id')->count('respondent_id');
        $jumlahKritikSaran = Feedback::count(); 

        $jenisKelaminData = $this->calculateDistribution('jenis_kelamin');
        $usiaData = $this->calculateDistribution('usia');
        $pendidikanData = $this->calculateDistribution('pendidikan');
        $pekerjaanData = $this->calculateDistribution('pekerjaan');

        return view('admin.ikm.index', [
            'surveys' => $surveyTerpilih,
            'allSurveys' => $semuaSurvey,
            'bobotNilaiTetimbang' => $bobotNilaiTetimbang,
            'jumlahNilaiUnsur' => $dataUnsur['jumlahNilaiUnsur'],
            'nrrUnsur' => $dataUnsur['nrrUnsur'],
            'tetimbangPerUnsur' => $dataUnsur['tetimbangPerUnsur'],
            'ikm' => $ikm,
            'rating' => $rating,
            'chartData' => [
                'labels' => $surveyTerpilih->flatMap(fn($survey) => $survey->questions->pluck('question_text'))->toArray(),
                'data' => collect($dataUnsur['tetimbangPerUnsur'])->values()->toArray(),
            ],
            'likertCounts' => $likertCounts,
            'jumlahPertanyaan' => $jumlahPertanyaan,
            'jumlahJawaban' => $jumlahJawaban,
            'jumlahResponden' => $jumlahResponden,
            'jumlahKritikSaran' => $jumlahKritikSaran,
            'jenisKelaminData' => $jenisKelaminData,
            'usiaData' => $usiaData,
            'pendidikanData' => $pendidikanData,
            'pekerjaanData' => $pekerjaanData,
        ]);
    }

    private function ambilSurveyDenganPertanyaan($surveyId)
    {
        return Survey::with('questions')
            ->when($surveyId, fn($query) => $query->where('id', $surveyId))
            ->orderBy('id', 'asc')
            ->get();
    }

    private function hitungBobotNilaiTetimbang($surveys)
    {
        $jumlahPertanyaan = $surveys->sum(fn($survey) => $survey->questions->count());
        return $jumlahPertanyaan > 0 ? 1 / $jumlahPertanyaan : 0;
    }

    private function hitungJumlahNilaiUnsur($questionId)
    {
        return ResponseDetail::where('question_id', $questionId)->sum('likert_value');
    }

    private function hitungNrrUnsur($questionId)
    {
        $jumlahNilaiUnsur = $this->hitungJumlahNilaiUnsur($questionId);
        $jumlahResponden = ResponseDetail::where('question_id', $questionId)->distinct('response_id')->count('response_id');
        return $jumlahResponden > 0 ? $jumlahNilaiUnsur / $jumlahResponden : 0;
    }

    private function hitungTetimbangPerUnsur($questionId, $bobotNilaiTetimbang)
    {
        $nrrUnsur = $this->hitungNrrUnsur($questionId);
        return $nrrUnsur * $bobotNilaiTetimbang;
    }

    private function menghitungIkm($tetimbangPerUnsur)
    {
        return collect($tetimbangPerUnsur)->sum() * 25;
    }

    private function determineRating($ikm)
    {
        return match (true) {
            $ikm < 65.00 => 'Tidak Baik',
            $ikm < 76.61 => 'Kurang Baik',
            $ikm < 88.31 => 'Baik',
            default => 'Sangat Baik',
        };
    }

    private function hitungLikertCounts($surveyTerpilih)
    {
        $questionIds = $surveyTerpilih->flatMap(fn($survey) => $survey->questions->pluck('id'));
        $likertCounts = ResponseDetail::whereIn('question_id', $questionIds)
            ->selectRaw('likert_value, COUNT(*) as count')
            ->groupBy('likert_value')
            ->pluck('count', 'likert_value')
            ->toArray();

        return array_replace([1 => 0, 2 => 0, 3 => 0, 4 => 0], $likertCounts);
    }

    private function prosesUnsur($surveyTerpilih, $bobotNilaiTetimbang)
    {
        $jumlahNilaiUnsur = [];
        $nrrUnsur = [];
        $tetimbangPerUnsur = [];

        foreach ($surveyTerpilih as $survey) {
            foreach ($survey->questions as $question) {
                $questionId = $question->id;
                $jumlahNilaiUnsur[$questionId] = $this->hitungJumlahNilaiUnsur($questionId);
                $nrrUnsur[$questionId] = $this->hitungNrrUnsur($questionId);
                $tetimbangPerUnsur[$questionId] = $this->hitungTetimbangPerUnsur($questionId, $bobotNilaiTetimbang);
            }
        }

        return compact('jumlahNilaiUnsur', 'nrrUnsur', 'tetimbangPerUnsur');
    }

    private function calculateDistribution($field)
    {
        $surveyId = request('survey_id');

        if (in_array($field, ['jenis_kelamin', 'usia', 'pendidikan', 'pekerjaan'])) {
            $data = \App\Models\Respondent::selectRaw("$field, COUNT(*) as count")
                ->join('responses', 'respondents.id', '=', 'responses.respondent_id')
                ->when($surveyId, fn($query) => $query->where('responses.survey_id', $surveyId))
                ->groupBy($field)
                ->pluck('count', $field)
                ->toArray();

            if ($field === 'usia') {
                // Map age ranges to predefined categories
                $mappedData = [
                    'Anak-anak(0-12)' => 0,
                    'Remaja(13-19)' => 0,
                    'Dewasa(20-59)' => 0,
                    'Lansia(>=50)' => 0,
                ];

                foreach ($data as $age => $count) {
                    if ($age >= 0 && $age <= 12) {
                        $mappedData['Anak-anak(0-12)'] += $count;
                    } elseif ($age >= 13 && $age <= 19) {
                        $mappedData['Remaja(13-19)'] += $count;
                    } elseif ($age >= 20 && $age <= 59) {
                        $mappedData['Dewasa(20-59)'] += $count;
                    } elseif ($age >= 60) {
                        $mappedData['Lansia(>=50)'] += $count;
                    }
                }

                return $mappedData;
            }

            return $data;
        }

        return Response::selectRaw("$field, COUNT(*) as count")
            ->when($surveyId, fn($query) => $query->where('survey_id', $surveyId))
            ->groupBy($field)
            ->pluck('count', $field)
            ->toArray();
    }

}
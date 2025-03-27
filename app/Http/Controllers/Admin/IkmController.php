<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\ResponseDetail;
use App\Models\Response;
use App\Models\Unsur;

class IkmController extends Controller
{
    public function index()
    {
        $surveyId = request('survey_id');
        $semuaSurvey = Survey::all();

        $surveyTerpilih = $this->ambilSurveyDenganPertanyaan($surveyId);
        
        $jumlahNilaiUnsur = [];
        $nrrUnsur = [];
        $tetimbangPerUnsur = [];

        $bobotNilaiTetimbang = $this->hitungBobotNilaiTetimbang($surveyTerpilih);

        foreach ($surveyTerpilih as $survey) {
            foreach ($survey->questions as $question) {
                $jumlahNilaiUnsur[$question->id] = $this->hitungJumlahNilaiUnsur($question->id);
                $nrrUnsur[$question->id] = $this->hitungNrrUnsur($question->id);
                $tetimbangPerUnsur[$question->id] = $this->hitungTetimbangPerUnsur($question->id, $bobotNilaiTetimbang);
            }
        }

        // Calculate IKM after populating tetimbangPerUnsur
        $ikm = $this->menghitungIkm($tetimbangPerUnsur);

        // Determine the rating interval
        $rating = $this->determineRating($ikm);

        return view('admin.ikm.index', [
            'surveys' => $surveyTerpilih,
            'allSurveys' => $semuaSurvey,
            'bobotNilaiTetimbang' => $bobotNilaiTetimbang,
            'jumlahNilaiUnsur' => $jumlahNilaiUnsur,
            'nrrUnsur' => $nrrUnsur,
            'tetimbangPerUnsur' => $tetimbangPerUnsur,
            'ikm' => $ikm,
            'rating' => $rating,
        ]);
    }

    private function ambilSurveyDenganPertanyaan($surveyId)
    {
        return Survey::with('questions')
            ->when($surveyId, fn($query) => $query->where('id', $surveyId))
            ->get();
    }

    private function hitungJumlahNilaiUnsur($questionId)
    {
        return ResponseDetail::where('question_id', $questionId)->sum('likert_value');
    }
    private function hitungBobotNilaiTetimbang($surveys)
    {
        $jumlahPertanyaan = $surveys->sum(fn($survey) => $survey->questions->count());
        return $jumlahPertanyaan > 0 ? 1 / $jumlahPertanyaan : 0;
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
        if ($ikm < 65.00) {
            return 'Tidak Baik';
        } elseif ($ikm < 76.61) {
            return 'Kurang Baik';
        } elseif ($ikm < 88.31) {
            return 'Baik';
        } else {
            return 'Sangat Baik';
        }
    }
}

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

        $data = $this->hitungDataSurvey($surveyTerpilih);

        // Hitung IKM sebagai jumlah semua NRR Tetimbang per Unsur
        $ikm = array_sum(array_column($data['detail'], 'nrrTetimbang'));
        $persentaseIkm = $ikm * 100; // Konversi ke persentase
        $kategoriKepuasan = $this->ambilLabelKepuasan($persentaseIkm);

        return view('admin.ikm.index', [
            'surveys' => $surveyTerpilih,
            'allSurveys' => $semuaSurvey,
            'data' => $data['detail'],
            'ikm' => $ikm,
            'ikmPercentage' => $persentaseIkm,
            'satisfactionLabel' => $kategoriKepuasan,
            'nilaiTertimbang' => $data['nilaiTertimbang'],
        ]);
    }

    private function ambilSurveyDenganPertanyaan($surveyId)
    {
        return Survey::with('questions')
            ->when($surveyId, function ($query, $surveyId) {
                return $query->where('id', $surveyId);
            })
            ->get();
    }

    private function hitungDataSurvey($surveyTerpilih)
    {
        $detail = [];
        $totalNilaiTertimbang = 0;
        $totalBobot = 0;
        $totalNrr = 0; // Total NRR dari semua unsur

        $jumlahUnsur = Unsur::count();
        $nilaiMaksimumLikert = 4; // Nilai maksimum pada skala Likert

        foreach ($surveyTerpilih as $survey) {
            foreach ($survey->questions as $pertanyaan) {
                // Jumlah Nilai Per Unsur: Total skor dari semua responden untuk pertanyaan ini
                $jumlahNilaiUnsur = ResponseDetail::where('question_id', $pertanyaan->id)->sum('likert_value');
                $jumlahResponden = Response::where('survey_id', $survey->id)->count();

                // NRR Per Unsur: Jumlah Nilai Per Unsur dibagi dengan (Jumlah Responden × Nilai Maksimum Likert)
                $nrr = ($jumlahResponden > 0 && $jumlahNilaiUnsur > 0)
                    ? $jumlahNilaiUnsur / ($jumlahResponden * $nilaiMaksimumLikert)
                    : 0;

                // Hitung nilai tertimbang (NRR Nilai Tetimbang)
                $bobot = $pertanyaan->weight ?? 1; // Ganti dengan logika bobot yang sesuai
                $nrrNilaiTertimbang = $nrr * $bobot;

                $detail[$pertanyaan->id] = [
                    'jumlahResponden' => $jumlahResponden,
                    'jumlahNilaiUnsur' => $jumlahNilaiUnsur, // Jumlah Nilai Per Unsur
                    'nrr' => $nrr, // NRR Per Unsur
                    'nrrNilaiTertimbang' => $nrrNilaiTertimbang,
                ];

                $totalNilaiTertimbang += $nrrNilaiTertimbang;
                $totalBobot += $bobot;
                $totalNrr += $nrr; // Tambahkan NRR ke total NRR
            }
        }

        // Hitung Bobot Nilai Tetimbang untuk setiap unsur
        foreach ($detail as $id => $unsur) {
            $detail[$id]['bobotNilaiTertimbang'] = $totalNrr > 0 ? $unsur['nrr'] / $totalNrr : 0;

            // Hitung NRR Tetimbang per Unsur
            $detail[$id]['nrrTetimbang'] = $detail[$id]['bobotNilaiTertimbang'] * $unsur['nrr'];
        }

        $nilaiTertimbang = $jumlahUnsur > 0 ? $totalBobot / $jumlahUnsur : 0;

        return [
            'detail' => $detail,
            'totalNilaiTertimbang' => $totalNilaiTertimbang,
            'totalBobot' => $totalBobot,
            'nilaiTertimbang' => $nilaiTertimbang,
        ];
    }

    private function ambilLabelKepuasan($persentaseIkm)
    {
        if ($persentaseIkm >= 0 && $persentaseIkm < 40) {
            return 'Sangat Tidak Puas';
        } elseif ($persentaseIkm >= 40 && $persentaseIkm < 60) {
            return 'Tidak Puas';
        } elseif ($persentaseIkm >= 60 && $persentaseIkm < 80) {
            return 'Puas';
        } elseif ($persentaseIkm >= 80) {
            return 'Sangat Puas';
        }

        return '';
    }
}

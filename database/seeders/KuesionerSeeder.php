<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Support\Facades\DB;

class KuesionerSeeder extends Seeder
{
    public function run()
    {
        // Mapping pertanyaan per unsur.
        $questionsMapping = [
            'Persyaratan' => [
                'Seberapa jelas dan mudah dipahami persyaratan yang diberikan?',
                'Apakah Anda mengalami kesulitan dalam memenuhi persyaratan yang ditetapkan?',
                'Bagaimana tingkat kepuasan Anda terhadap informasi yang disediakan tentang persyaratan?',
            ],
            'Sistem, Mekanisme, dan Prosedur' => [
                'Sejauh mana prosedur pelayanan terlihat efisien dan efektif bagi Anda?',
                'Apakah ada aspek prosedur yang menurut Anda perlu ditingkatkan atau disederhanakan?',
                'Bagaimana pengalaman Anda dalam mengikuti prosedur pelayanan?',
            ],
            'Waktu Pelayanan' => [
                'Seberapa cepat pelayanan diberikan sesuai dengan waktu yang dijanjikan?',
                'Apakah ada peningkatan yang dapat dilakukan dalam mengurangi waktu tunggu?',
                'Bagaimana tingkat kepuasan Anda terhadap kecepatan pelayanan yang diberikan?',
            ],
            'Biaya Tarif' => [
                'Apakah biaya yang dikenakan sesuai dengan kualitas pelayanan yang Anda terima?',
                'Apakah ada klarifikasi yang diperlukan terkait dengan biaya tarif?',
                'Bagaimana tingkat kepuasan Anda terhadap nilai uang dari biaya yang dikeluarkan?',
            ],
            'Produk Layanan' => [
                'Apakah produk layanan yang diberikan memenuhi harapan Anda?',
                'Apakah ada aspek khusus dari produk layanan yang menurut Anda perlu diperbaiki?',
                'Bagaimana tingkat kepuasan Anda terhadap variasi produk layanan yang ditawarkan?',
            ],
            'Kompetensi Pelaksana' => [
                'Seberapa kompeten dan berpengetahuan para pelaksana dalam memberikan pelayanan?',
                'Apakah Anda merasa puas dengan tingkat keahlian para pelaksana?',
                'Apakah ada area di mana pelaksana dapat meningkatkan kompetensinya?',
            ],
            'Perilaku Pelaksana' => [
                'Sejauh mana pelaksana memberikan pelayanan dengan sikap ramah dan profesional?',
                'Apakah Anda pernah mengalami perilaku pelaksana yang tidak diinginkan?',
                'Bagaimana tingkat kepuasan Anda terhadap interaksi dengan pelaksana?',
            ],
            'Sarana dan Prasarana' => [
                'Bagaimana kualitas sarana dan prasarana yang disediakan untuk pelayanan?',
                'Apakah ada fasilitas atau peralatan yang perlu diperbaiki atau ditingkatkan?',
                'Bagaimana tingkat kepuasan Anda terhadap kondisi sarana dan prasarana?',
            ],
            'Penanganan Pengaduan' => [
                'Apakah Anda puas dengan cara pengaduan Anda ditangani?',
                'Apakah ada saran yang dapat diberikan untuk meningkatkan proses penanganan pengaduan?',
                'Bagaimana tingkat kepuasan Anda terhadap respons terhadap pengaduan yang Anda ajukan?',
            ],
        ];

        // Dapatkan seluruh survey yang sudah ada (misalnya dari SurveySeeder)
        $surveys = Survey::all();

        foreach ($surveys as $survey) {
            $order = 1; // reset question_order untuk setiap survey baru
            foreach ($questionsMapping as $unsurName => $questionList) {
                // Cari data unsur berdasarkan nama pada tabel unsurs
                $unsur = DB::table('unsur')->where('unsur_name', $unsurName)->first();

                if ($unsur) {
                    foreach ($questionList as $questionText) {
                        Question::create([
                            'survey_id'     => $survey->id,
                            'unsur_id'      => $unsur->id,
                            'question_text' => $questionText,
                            'question_order'=> $order,
                        ]);
                        $order++;
                    }
                }
            }
        }
    }
}

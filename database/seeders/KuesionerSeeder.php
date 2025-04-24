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
            'Seberapa sulit atau mudah Anda memahami persyaratan yang diberikan?',
            'Seberapa besar kesulitan yang Anda alami dalam memenuhi persyaratan yang ditetapkan?',
            'Seberapa rendah atau tinggi tingkat kepuasan Anda terhadap informasi yang disediakan tentang persyaratan?',
            ],
            'Sistem, Mekanisme, dan Prosedur' => [
            'Seberapa tidak efisien atau efisien prosedur pelayanan menurut Anda?',
            'Seberapa mendesak menurut Anda aspek prosedur perlu ditingkatkan atau disederhanakan?',
            'Bagaimana pengalaman Anda dalam mengikuti prosedur pelayanan? (Sulit/Mudah)',
            ],
            'Waktu Pelayanan' => [
            'Seberapa lambat atau cepat pelayanan diberikan dibandingkan waktu yang dijanjikan?',
            'Seberapa besar potensi peningkatan yang dapat dilakukan dalam mengurangi waktu tunggu menurut Anda?',
            'Seberapa rendah atau tinggi tingkat kepuasan Anda terhadap kecepatan pelayanan yang diberikan?',
            ],
            'Biaya Tarif' => [
            'Seberapa tidak sesuai atau sesuai biaya yang dikenakan dengan kualitas pelayanan yang Anda terima?',
            'Seberapa besar kebutuhan klarifikasi terkait dengan biaya tarif menurut Anda?',
            'Seberapa buruk atau baik nilai uang dari biaya yang Anda keluarkan menurut Anda?',
            ],
            'Produk Layanan' => [
            'Seberapa jauh produk layanan yang diberikan tidak memenuhi atau memenuhi harapan Anda?',
            'Seberapa signifikan aspek khusus dari produk layanan perlu diperbaiki menurut Anda?',
            'Seberapa terbatas atau beragam variasi produk layanan yang ditawarkan menurut Anda?',
            ],
            'Kompetensi Pelaksana' => [
            'Seberapa kurang kompeten atau kompeten para pelaksana dalam memberikan pelayanan menurut Anda?',
            'Seberapa tidak puas atau puas Anda dengan tingkat keahlian para pelaksana?',
            'Seberapa besar area di mana pelaksana dapat meningkatkan kompetensinya menurut Anda?',
            ],
            'Perilaku Pelaksana' => [
            'Seberapa tidak ramah atau ramah dan tidak profesional atau profesional sikap pelaksana dalam memberikan pelayanan?',
            'Seberapa sering Anda mengalami perilaku pelaksana yang tidak diinginkan?',
            'Seberapa negatif atau positif tingkat kepuasan Anda terhadap interaksi dengan pelaksana?',
            ],
            'Sarana dan Prasarana' => [
            'Seberapa buruk atau baik kualitas sarana dan prasarana yang disediakan untuk pelayanan?',
            'Seberapa mendesak perbaikan atau peningkatan fasilitas atau peralatan yang perlu dilakukan menurut Anda?',
            'Seberapa tidak puas atau puas Anda terhadap kondisi sarana dan prasarana?',
            ],
            'Penanganan Pengaduan' => [
            'Seberapa tidak puas atau puas Anda dengan cara pengaduan Anda ditangani?',
            'Seberapa signifikan saran yang dapat diberikan untuk meningkatkan proses penanganan pengaduan menurut Anda?',
            'Seberapa lambat atau cepat respons terhadap pengaduan yang Anda ajukan?',
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
                            'survey_id' => $survey->id,
                            'unsur_id' => $unsur->id,
                            'question_text' => $questionText,
                            'question_order' => $order,
                        ]);
                        $order++;
                    }
                }
            }
        }
    }
}

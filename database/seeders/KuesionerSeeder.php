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
                'Seberapa mudah Anda memahami persyaratan yang diberikan?',
                'Bagaimana kelancaran proses pemenuhan persyaratan menurut pengalaman Anda?',
                'Kejelasan informasi mengenai persyaratan, bagaimana penilaian Anda?',
            ],
            'Sistem, Mekanisme, dan Prosedur' => [
                'Menurut pandangan Anda, seberapa efisien mekanisme pelayanan saat ini?',
                'Perlukah penyederhanaan prosedur pelayanan menurut pendapat Anda?',
                'Seberapa mudah tahapan prosedur pelayanan untuk Anda ikuti?',
            ],
            'Waktu Pelayanan' => [
                'Apakah waktu pelayanan yang diberikan sesuai dengan yang dijanjikan?',
                'Bagaimana Anda menilai singkatnya waktu tunggu pelayanan?',
                'Seberapa memuaskan kecepatan pelayanan yang Anda terima?',
            ],
            'Kualitas Produk Layanan' => [
                'Apakah produk layanan yang diberikan telah memenuhi harapan Anda?',
                'Menurut Anda, aspek mana dari produk layanan yang memerlukan perbaikan?',
                'Bagaimana pendapat Anda mengenai variasi produk layanan yang ditawarkan? Apakah sudah memadai?',
            ],
            'Kemudahan Penggunaan Website' => [
                'Menurut penilaian Anda, seberapa mudah navigasi website ini?',
                'Seberapa intuitif tata letak (layout) dan desain website menurut Anda?',
                'Bagaimana kemudahan Anda dalam mengakses informasi yang dibutuhkan melalui website ini?',
            ],
            'Responsifitas Website' => [
                'Seberapa cepat waktu muat (loading time) website menurut pengalaman Anda?',
                'Bagaimana respons website terhadap interaksi Anda (klik, input data, dll.)?',
                'Apakah website dapat diakses dengan baik melalui perangkat yang Anda gunakan (komputer, tablet, atau telepon genggam)?',
            ],
            'Perilaku Pelaksana' => [
                'Apakah Anda setuju bahwa bahasa yang digunakan di website sudah jelas dan ramah?',
                'Seberapa membantu fitur-fitur interaktif (jika ada, seperti chatbot atau FAQ) dalam menyelesaikan kebutuhan Anda?',
                'Apakah Anda menilai interaksi dengan sistem melalui website ini sudah memuaskan?',
            ],
            'Sarana dan Prasarana' => [
                'Menurut Anda, bagaimana kualitas visual (gambar, ikon, dll.) yang disajikan dalam website?',
                'Apakah fitur-fitur pendukung yang ada di website sudah memadai?',
                'Apakah Anda menilai bahwa keamanan dan privasi di website ini terjamin dengan baik?',
            ],
            'Penanganan Pengaduan' => [
                'Jika Anda pernah mengajukan pengaduan, seberapa puas Anda dengan penanganannya? Jika belum, silakan berikan penilaian Anda terhadap potensi efektivitas mekanisme penanganan pengaduan yang tersedia di website.',
                'Sepakatkah Anda bahwa fitur pendukung di website ini sudah lengkap tanpa perlu penambahan?',
                'Apakah anda dapat menilai bahwa pengaduan akan direspons dengan cepat melalui website ini?',
            ],
        ];
        $surveys = Survey::all();
        foreach ($surveys as $survey) {
            $order = 1;
            foreach ($questionsMapping as $unsurName => $questionList) {
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

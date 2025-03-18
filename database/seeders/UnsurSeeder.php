<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unsur;

class UnsurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $unsurs = [
            [
                'unsur_name' => 'Persyaratan',
                'description' => 'Persyaratan adalah syarat yang harus dipenuhi dalam pengurusan suatu jenis pelayanan, baik persyaratan teknis maupun administratif.',
            ],
            [
                'unsur_name' => 'Sistem, Mekanisme, dan Prosedur',
                'description' => 'Prosedur adalah tata cara pelayanan yang dibakukan bagi pemberi dan penerima pelayanan, termasuk pengaduan.',
            ],
            [
                'unsur_name' => 'Waktu Pelayanan',
                'description' => 'Waktu Pelayanan mengacu pada seberapa cepat pelayanan diberikan sesuai dengan waktu yang dijanjikan.',
            ],
            [
                'unsur_name' => 'Biaya Tarif',
                'description' => 'Biaya Tarif adalah biaya yang dikenakan sesuai dengan kualitas pelayanan yang diberikan.',
            ],
            [
                'unsur_name' => 'Produk Layanan',
                'description' => 'Produk Layanan mencakup produk atau layanan yang diberikan kepada masyarakat.',
            ],
            [
                'unsur_name' => 'Kompetensi Pelaksana',
                'description' => 'Kompetensi Pelaksana merujuk pada keahlian dan pengetahuan para pelaksana dalam memberikan pelayanan.',
            ],
            [
                'unsur_name' => 'Perilaku Pelaksana',
                'description' => 'Perilaku Pelaksana mengacu pada sikap dan perilaku para pelaksana dalam memberikan pelayanan.',
            ],
            [
                'unsur_name' => 'Sarana dan Prasarana',
                'description' => 'Sarana dan Prasarana adalah fasilitas fisik dan peralatan yang mendukung proses pelayanan.',
            ],
            [
                'unsur_name' => 'Penanganan Pengaduan',
                'description' => 'Penanganan Pengaduan mencakup proses penanganan dan penyelesaian pengaduan dari masyarakat.',
            ],
        ];
        
        foreach ($unsurs as $unsur) {
            Unsur::create($unsur);
        }
    }
}

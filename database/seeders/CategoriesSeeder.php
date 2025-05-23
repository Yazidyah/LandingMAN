<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['banner','visimisi','agenda', 'fasilitas', 'berita', 'prestasi'];

        foreach ($categories as $category) {
            Category::create(['category_name' => $category]);
        }
    }
}

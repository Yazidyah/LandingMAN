<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Survey;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $surveys = [
            [
                'survey_name' => 'Survey Kepuasan Pengguna',
                'description' => 'Survey untuk mengukur kepuasan pengguna.',
                'start_date' => '2025-03-01',
                'end_date'   => '2025-04-30',
            ],
            [
                'survey_name' => 'Survey PPDB',
                'description' => 'Survey untuk calon peserta didik baru.',
                'start_date' => '2025-03-01',
                'end_date'   => '2025-04-30',
            ],
        ];
        foreach ($surveys as $survey) {
            Survey::create($survey);
        }
    }
}

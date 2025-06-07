<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@man1kotabogor.id',
            'password' => bcrypt('password'),
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@man1kotabogor.id',
            'password' => bcrypt('password'),
        ]);

        $this->call(CategoriesSeeder::class);
        $this->call(SurveySeeder::class);
        $this->call(UnsurSeeder::class);
        $this->call(KuesionerSeeder::class);
    }
}

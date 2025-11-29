<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TryoutSeeder::class,
            BeasiswaSeeder::class,
            AcademicEventSeeder::class,
        ]);
    }
}

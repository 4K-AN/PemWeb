<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate([
            'name' => 'gopi',
            'email' => 'rafi.kamasyamsi@gmail.com',
            'password' => bcrypt('123'),
        ]);

        $this->call(BeasiswaSeeder::class);
    }
}

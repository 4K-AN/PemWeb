<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileTestSeeder extends Seeder
{
    /**
     * Seed the application's database with test users for profile testing
     */
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@edvizo.com'],
            [
                'name' => 'Admin Edvizo',
                'phone' => '081234567890',
                'bio' => 'Administrator sistem Edvizo - PemWeb Project',
                'password' => Hash::make('admin123'),
            ]
        );

        // Test User 1 - Siswa IPA
        User::firstOrCreate(
            ['email' => 'budi@example.com'],
            [
                'name' => 'Budi Santoso',
                'phone' => '082345678901',
                'bio' => 'Siswa SMA jurusan IPA, tertarik bidang teknik dan robotika. Ingin melanjutkan ke ITB atau Telkom University.',
                'password' => Hash::make('password123'),
            ]
        );

        // Test User 2 - Siswa IPS
        User::firstOrCreate(
            ['email' => 'siti@example.com'],
            [
                'name' => 'Siti Nurhaliza',
                'phone' => '083456789012',
                'bio' => 'Calon mahasiswa IPS, minat pada bidang bisnis, ekonomi, dan manajemen. Tertarik dengan beasiswa luar negeri.',
                'password' => Hash::make('password123'),
            ]
        );

        // Test User 3 - Calon Mahasiswa Baru
        User::firstOrCreate(
            ['email' => 'raka@example.com'],
            [
                'name' => 'Raka Wijaya',
                'phone' => '084567890123',
                'bio' => 'Fresh graduate tahun 2024, sedang mencari informasi perkuliahan dan beasiswa untuk tahun depan.',
                'password' => Hash::make('password123'),
            ]
        );

        // Test User 4 - Developer Tester
        User::firstOrCreate(
            ['email' => 'tester@edvizo.com'],
            [
                'name' => 'Tester Developer',
                'phone' => '085678901234',
                'bio' => 'Quality Assurance - Testing semua fitur aplikasi Edvizo termasuk profile page.',
                'password' => Hash::make('password123'),
            ]
        );
    }
}

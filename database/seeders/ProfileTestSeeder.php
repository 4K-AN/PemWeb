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
                'interests_talents' => 'Ahli dalam manajemen, leadership, dan problem solving. Tertarik dengan teknologi dan bisnis digital.',
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
                'interests_talents' => 'Senang dengan matematika dan fisika. Pandai dalam programming, web development, dan problem solving. Tertarik dengan robotika, IoT, dan AI. Aktif mengikuti kompetisi programming dan hackathon. Suka berkerjasama dan belajar hal baru.',
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
                'interests_talents' => 'Tertarik dengan ekonomi, bisnis, dan keuangan. Pandai dalam berkomunikasi, presentasi, dan negotiation. Menyukai riset pasar dan analisis data. Aktif dalam organisasi dan kegiatan sosial. Impian membuka bisnis sendiri di masa depan.',
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
                'interests_talents' => 'Hobi desain grafis dan fotografi. Tertarik dengan seni dan kreativitas. Pandai dalam UI/UX design dan digital marketing. Punya portfolio beberapa project design. Ingin mengembangkan karir di industri kreatif atau media.',
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
                'interests_talents' => 'Ahli dalam full-stack development dengan Java, Python, PHP, dan JavaScript. Menguasai database design, API development, dan software architecture. Tertarik dengan machine learning dan data science. Pengalaman 5+ tahun dalam software engineering.',
                'password' => Hash::make('password123'),
            ]
        );
    }
}

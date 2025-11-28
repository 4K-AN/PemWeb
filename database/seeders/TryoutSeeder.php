<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tryout;

class TryoutSeeder extends Seeder
{
    public function run(): void
    {
        $tryouts = [
            [
                'nama_tryout' => 'Tryout UTBK 2025 Batch 1',
                'deskripsi' => 'Tryout UTBK berbasis CBT dengan sistem penilaian yang sama dengan UTBK asli. Dilengkapi dengan pembahasan lengkap dan analisis hasil.',
                'penyelenggara' => 'Ruangguru',
                'kategori' => 'UTBK',
                'tanggal_pelaksanaan' => '2025-02-15',
                'waktu_mulai' => '08:00:00',
                'waktu_selesai' => '12:00:00',
                'lokasi' => 'Online',
                'biaya' => 50000,
                'link_pendaftaran' => 'https://ruangguru.com/tryout',
                'deadline_pendaftaran' => '2025-02-10',
                'is_active' => true
            ],
            [
                'nama_tryout' => 'Simulasi SBMPTN Zenius',
                'deskripsi' => 'Simulasi ujian SBMPTN dengan tingkat kesulitan setara ujian sebenarnya. Dapatkan ranking nasional dan prediksi PTN.',
                'penyelenggara' => 'Zenius Education',
                'kategori' => 'SBMPTN',
                'tanggal_pelaksanaan' => '2025-03-01',
                'waktu_mulai' => '09:00:00',
                'waktu_selesai' => '13:00:00',
                'lokasi' => 'Online',
                'biaya' => 75000,
                'link_pendaftaran' => 'https://zenius.net/tryout',
                'deadline_pendaftaran' => '2025-02-25',
                'is_active' => true
            ],
            [
                'nama_tryout' => 'Tryout Gratis UTBK Quipper',
                'deskripsi' => 'Tryout UTBK gratis untuk persiapan menghadapi seleksi masuk PTN. Gratis untuk 1000 peserta pertama.',
                'penyelenggara' => 'Quipper',
                'kategori' => 'UTBK',
                'tanggal_pelaksanaan' => '2025-02-20',
                'waktu_mulai' => '10:00:00',
                'waktu_selesai' => '14:00:00',
                'lokasi' => 'Online',
                'biaya' => 0,
                'link_pendaftaran' => 'https://quipper.com/tryout',
                'deadline_pendaftaran' => '2025-02-18',
                'is_active' => true
            ],
            [
                'nama_tryout' => 'Tryout Mandiri UI 2025',
                'deskripsi' => 'Tryout khusus persiapan ujian mandiri Universitas Indonesia. Pola soal disesuaikan dengan ujian tahun sebelumnya.',
                'penyelenggara' => 'Bimbel Ganessha',
                'kategori' => 'Mandiri',
                'tanggal_pelaksanaan' => '2025-03-10',
                'waktu_mulai' => '08:00:00',
                'waktu_selesai' => '11:00:00',
                'lokasi' => 'Offline - Jakarta',
                'biaya' => 100000,
                'link_pendaftaran' => 'https://ganeshha.com/tryout-ui',
                'deadline_pendaftaran' => '2025-03-05',
                'is_active' => true
            ],
            [
                'nama_tryout' => 'Tryout UTBK Intensif',
                'deskripsi' => 'Program tryout intensif dengan 5 kali pelaksanaan. Lengkap dengan video pembahasan dan konsultasi mentor.',
                'penyelenggara' => 'Pahamify',
                'kategori' => 'UTBK',
                'tanggal_pelaksanaan' => '2025-02-25',
                'waktu_mulai' => '13:00:00',
                'waktu_selesai' => '17:00:00',
                'lokasi' => 'Online',
                'biaya' => 150000,
                'link_pendaftaran' => 'https://pahamify.com/tryout',
                'deadline_pendaftaran' => '2025-02-20',
                'is_active' => true
            ],
        ];

        foreach ($tryouts as $tryout) {
            Tryout::create($tryout);
        }
    }
}

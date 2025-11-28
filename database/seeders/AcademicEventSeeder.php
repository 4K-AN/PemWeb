<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicEvent;

class AcademicEventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Pendaftaran Siswa Baru',
                'description' => 'Periode pendaftaran siswa baru untuk tahun akademik 2024/2025. Calon siswa dapat mendaftar melalui portal online atau datang langsung ke kantor pendaftaran.',
                'event_date' => '2025-01-05',
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
                'location' => 'Kantor Pendaftaran / Online',
                'category' => 'Pendaftaran',
                'icon' => 'user-plus'
            ],
            [
                'title' => 'Orientasi Siswa Baru',
                'description' => 'Program orientasi untuk siswa baru mencakup pengenalan lingkungan sekolah, peraturan akademik, dan kegiatan ekstrakurikuler.',
                'event_date' => '2025-01-18',
                'start_time' => '07:00:00',
                'end_time' => '14:00:00',
                'location' => 'Aula Utama',
                'category' => 'Akademik',
                'icon' => 'graduation-cap'
            ],
            [
                'title' => 'Mulai Tahun Ajaran Baru',
                'description' => 'Hari pertama kegiatan belajar mengajar tahun akademik 2024/2025. Siswa diharapkan hadir tepat waktu.',
                'event_date' => '2025-01-21',
                'start_time' => '07:00:00',
                'end_time' => '14:00:00',
                'location' => 'Semua Kelas',
                'category' => 'Pembelajaran',
                'icon' => 'book-open'
            ],
            [
                'title' => 'Ujian Tengah Semester',
                'description' => 'Pelaksanaan Ujian Tengah Semester (UTS) untuk semua mata pelajaran. Siswa wajib membawa kartu ujian dan alat tulis.',
                'event_date' => '2025-03-10',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'location' => 'Ruang Ujian',
                'category' => 'Ujian',
                'icon' => 'file-text'
            ],
            [
                'title' => 'Libur Semester Ganjil',
                'description' => 'Masa libur semester ganjil untuk siswa. Sekolah tutup untuk kegiatan akademik reguler.',
                'event_date' => '2025-06-20',
                'start_time' => null,
                'end_time' => null,
                'location' => null,
                'category' => 'Liburan',
                'icon' => 'sun'
            ],
            [
                'title' => 'Ujian Akhir Semester',
                'description' => 'Pelaksanaan Ujian Akhir Semester (UAS) untuk evaluasi pembelajaran satu semester penuh.',
                'event_date' => '2025-12-01',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'location' => 'Ruang Ujian',
                'category' => 'Ujian',
                'icon' => 'file-text'
            ],
            [
                'title' => 'Pengumuman Nilai Semester',
                'description' => 'Pengumuman hasil nilai akhir semester untuk semua siswa. Dapat diakses melalui portal siswa.',
                'event_date' => '2025-12-20',
                'start_time' => '10:00:00',
                'end_time' => null,
                'location' => 'Portal Online',
                'category' => 'Pengumuman',
                'icon' => 'bell'
            ],
        ];

        foreach ($events as $event) {
            AcademicEvent::create($event);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicEvent;
use Carbon\Carbon;

class AcademicEventSeeder extends Seeder
{
    public function run()
    {
        $events = [
            // Maret 2025
            [
                'title' => 'Hari Kehakiman Nasional',
                'description' => 'Peringatan Hari Kehakiman Nasional Indonesia yang diperingati setiap tanggal 1 Maret',
                'event_date' => Carbon::create(2025, 3, 1),
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'location' => 'Seluruh Indonesia',
                'category' => 'Akademik',
                'icon' => '⚖️'
            ],
            [
                'title' => 'Beasiswa Ngawi Selatan',
                'description' => 'Pembukaan pendaftaran beasiswa untuk mahasiswa berprestasi dari wilayah Ngawi Selatan',
                'event_date' => Carbon::create(2025, 3, 1),
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'location' => 'Online',
                'category' => 'Pendaftaran',
                'icon' => '🎓'
            ],
            [
                'title' => 'KOSTRAD (Komando Strategis Angkatan Darat)',
                'description' => 'Hari jadi KOSTRAD - Komando Strategis Angkatan Darat Indonesia',
                'event_date' => Carbon::create(2025, 3, 2),
                'start_time' => '07:00:00',
                'end_time' => '16:00:00',
                'location' => 'Jakarta',
                'category' => 'Akademik',
                'icon' => '🇮🇩'
            ],
            [
                'title' => 'Pengumuman Seleksi Mandiri UGM',
                'description' => 'Pengumuman hasil Seleksi Mandiri Universitas Gadjah Mada tahun akademik 2025/2026',
                'event_date' => Carbon::create(2025, 3, 2),
                'start_time' => '10:00:00',
                'end_time' => null,
                'location' => 'Online - Portal UGM',
                'category' => 'Pengumuman',
                'icon' => '📢'
            ],
            [
                'title' => 'Hari Perempuan Internasional',
                'description' => 'Perayaan International Women\'s Day dengan berbagai seminar dan workshop',
                'event_date' => Carbon::create(2025, 3, 15),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
                'location' => 'Berbagai Kampus',
                'category' => 'Akademik',
                'icon' => '👩'
            ],
            [
                'title' => 'Beasiswa Bakti Madiun Selatan',
                'description' => 'Program beasiswa untuk mahasiswa kurang mampu dari daerah Madiun Selatan',
                'event_date' => Carbon::create(2025, 3, 15),
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
                'location' => 'Online',
                'category' => 'Pendaftaran',
                'icon' => '💰'
            ],
            [
                'title' => 'Hari Musik Nasional',
                'description' => 'Peringatan Hari Musik Nasional dengan konser dan workshop musik',
                'event_date' => Carbon::create(2025, 3, 20),
                'start_time' => '09:00:00',
                'end_time' => '21:00:00',
                'location' => 'Jakarta',
                'category' => 'Akademik',
                'icon' => '🎵'
            ],
            [
                'title' => 'Pendaftaran Pre-test Mandiri ITB',
                'description' => 'Pembukaan pendaftaran pre-test untuk Ujian Mandiri Institut Teknologi Bandung',
                'event_date' => Carbon::create(2025, 3, 20),
                'start_time' => '00:00:00',
                'end_time' => '23:59:00',
                'location' => 'Online - Portal ITB',
                'category' => 'Pendaftaran',
                'icon' => '📝'
            ],
            [
                'title' => 'Hari Perawat Nasional',
                'description' => 'Peringatan Hari Perawat Nasional Indonesia',
                'event_date' => Carbon::create(2025, 3, 28),
                'start_time' => '08:00:00',
                'end_time' => '14:00:00',
                'location' => 'Seluruh Indonesia',
                'category' => 'Akademik',
                'icon' => '⚕️'
            ],
            [
                'title' => 'Hari Arsitektur Indonesia',
                'description' => 'Perayaan Hari Arsitektur Indonesia dengan pameran dan seminar',
                'event_date' => Carbon::create(2025, 3, 30),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
                'location' => 'Berbagai Kampus Arsitektur',
                'category' => 'Akademik',
                'icon' => '🏛️'
            ],
            [
                'title' => 'Hari Hutan Sedunia',
                'description' => 'International Day of Forests - kampanye pelestarian hutan',
                'event_date' => Carbon::create(2025, 3, 30),
                'start_time' => '07:00:00',
                'end_time' => '16:00:00',
                'location' => 'Seluruh Dunia',
                'category' => 'Akademik',
                'icon' => '🌲'
            ],
            [
                'title' => 'Hari Air Sedunia',
                'description' => 'World Water Day - kampanye konservasi air',
                'event_date' => Carbon::create(2025, 3, 30),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
                'location' => 'Global',
                'category' => 'Akademik',
                'icon' => '💧'
            ],
            [
                'title' => 'Hari Peringatan Bandung Lautan Api',
                'description' => 'Memperingati peristiwa heroik Bandung Lautan Api tahun 1946',
                'event_date' => Carbon::create(2025, 3, 30),
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'location' => 'Bandung',
                'category' => 'Akademik',
                'icon' => '🔥'
            ],

            // April 2025
            [
                'title' => 'Pendaftaran SNBP 2025',
                'description' => 'Pembukaan pendaftaran Seleksi Nasional Berdasarkan Prestasi (SNBP) tahun 2025',
                'event_date' => Carbon::create(2025, 4, 1),
                'start_time' => '00:00:00',
                'end_time' => '23:59:00',
                'location' => 'Online - Portal SNPMB',
                'category' => 'Pendaftaran',
                'icon' => '📝'
            ],
            [
                'title' => 'Hari Pendidikan Nasional',
                'description' => 'Peringatan Hari Pendidikan Nasional dengan berbagai kegiatan edukatif',
                'event_date' => Carbon::create(2025, 4, 2),
                'start_time' => '07:00:00',
                'end_time' => '17:00:00',
                'location' => 'Seluruh Indonesia',
                'category' => 'Akademik',
                'icon' => '🎓'
            ],
            [
                'title' => 'Workshop Persiapan UTBK',
                'description' => 'Workshop intensif persiapan menghadapi Ujian Tulis Berbasis Komputer',
                'event_date' => Carbon::create(2025, 4, 10),
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
                'location' => 'Online via Zoom',
                'category' => 'Pembelajaran',
                'icon' => '📚'
            ],
            [
                'title' => 'Seminar Nasional Teknologi',
                'description' => 'Seminar nasional tentang perkembangan teknologi dan inovasi terkini',
                'event_date' => Carbon::create(2025, 4, 15),
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'location' => 'Universitas Indonesia',
                'category' => 'Akademik',
                'icon' => '💻'
            ],
            [
                'title' => 'Ujian Tengah Semester Genap',
                'description' => 'Pelaksanaan Ujian Tengah Semester untuk semester genap 2024/2025',
                'event_date' => Carbon::create(2025, 4, 21),
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'location' => 'Kampus Masing-masing',
                'category' => 'Ujian',
                'icon' => '✏️'
            ],

            // Mei 2025
            [
                'title' => 'Hari Buruh Internasional',
                'description' => 'Peringatan Hari Buruh Sedunia - Libur Nasional',
                'event_date' => Carbon::create(2025, 5, 1),
                'start_time' => null,
                'end_time' => null,
                'location' => 'Seluruh Dunia',
                'category' => 'Liburan',
                'icon' => '🌴'
            ],
            [
                'title' => 'Pendaftaran UTBK-SNBT Gelombang 1',
                'description' => 'Pendaftaran Ujian Tulis Berbasis Komputer - Seleksi Nasional Berbasis Tes gelombang pertama',
                'event_date' => Carbon::create(2025, 5, 5),
                'start_time' => '00:00:00',
                'end_time' => '23:59:00',
                'location' => 'Online',
                'category' => 'Pendaftaran',
                'icon' => '📝'
            ],
            [
                'title' => 'Hari Pendidikan Nasional',
                'description' => 'Peringatan Hari Pendidikan Nasional Indonesia',
                'event_date' => Carbon::create(2025, 5, 2),
                'start_time' => '07:00:00',
                'end_time' => '17:00:00',
                'location' => 'Seluruh Indonesia',
                'category' => 'Akademik',
                'icon' => '🎓'
            ],
            [
                'title' => 'Career Fair 2025',
                'description' => 'Bursa kerja dan magang untuk mahasiswa dan fresh graduate',
                'event_date' => Carbon::create(2025, 5, 15),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
                'location' => 'JCC Jakarta',
                'category' => 'Akademik',
                'icon' => '💼'
            ],
            [
                'title' => 'Kenaikan Isa Almasih',
                'description' => 'Hari raya Kenaikan Isa Almasih - Libur Nasional',
                'event_date' => Carbon::create(2025, 5, 29),
                'start_time' => null,
                'end_time' => null,
                'location' => 'Indonesia',
                'category' => 'Liburan',
                'icon' => '🌴'
            ],
        ];

        foreach ($events as $event) {
            AcademicEvent::create($event);
        }
    }
}

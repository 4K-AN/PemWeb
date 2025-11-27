<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BeasiswaSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        
        DB::table('beasiswas')->insert([
            [
                'nama' => 'Beasiswa Unggulan Kemendikbud',
                'jurusan' => 'Semua Jurusan',
                'universitas' => 'PTN/PTS Indonesia',
                'status' => 'Dalam Negeri',
                'jenjang' => 'S1',
                'ipk_minimal' => 3.00,
                'deskripsi' => 'Diperuntukkan bagi mahasiswa berprestasi dengan IPK minimal 3.00',
                'gambar' => 'beasiswa/kemendikbud.jpg',
                'is_popular' => false,
                'deadline' => $now->copy()->addMonths(2),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Beasiswa Gojek Tech',
                'jurusan' => 'Teknologi Informasi',
                'universitas' => 'Universitas Indonesia',
                'status' => 'Dalam Negeri',
                'jenjang' => 'S1',
                'ipk_minimal' => 3.00,
                'deskripsi' => 'Program beasiswa untuk mahasiswa IT berprestasi',
                'gambar' => 'beasiswa/gojektech.jpg',
                'is_popular' => true,
                'deadline' => $now->copy()->addMonth(),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Beasiswa LPDP',
                'jurusan' => 'Semua Jurusan',
                'universitas' => 'Universitas Luar Negeri',
                'status' => 'Luar Negeri',
                'jenjang' => 'S2',
                'ipk_minimal' => 3.25,
                'deskripsi' => 'Beasiswa penuh untuk studi magister di luar negeri',
                'gambar' => 'beasiswa/lpdp.jpg',
                'is_popular' => true,
                'deadline' => $now->copy()->addMonths(3),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
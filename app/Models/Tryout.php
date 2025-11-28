<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tryout extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_tryout',
        'deskripsi',
        'penyelenggara',
        'kategori',
        'tanggal_pelaksanaan',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'biaya',
        'link_pendaftaran',
        'deadline_pendaftaran',
        'is_active'
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
        'deadline_pendaftaran' => 'date',
        'biaya' => 'decimal:2',
        'is_active' => 'boolean'
    ];
}

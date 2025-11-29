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
        'dengan_pembahasan',
        'dengan_sertifikat',
        'dengan_ranking',
        'is_active'
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
        'deadline_pendaftaran' => 'date',
        'biaya' => 'decimal:2',
        'dengan_pembahasan' => 'boolean',
        'dengan_sertifikat' => 'boolean',
        'dengan_ranking' => 'boolean',
        'is_active' => 'boolean'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'universitas',
        'jenis_beasiswa',
        'kategori',
        'negara',
        'status',
        'deadline',
        'jurusan',
        'link_pendaftaran',
        'gambar'
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    // Scope untuk filter
    public function scopeByJurusan($query, $jurusan)
    {
        if ($jurusan) {
            return $query->where('jurusan', 'like', '%' . $jurusan . '%');
        }
        return $query;
    }

    public function scopeByStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }
        return $query;
    }

    public function scopeByJenjang($query, $jenjang)
    {
        if ($jenjang) {
            return $query->where('jenjang', $jenjang);
        }
        return $query;
    }

    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}

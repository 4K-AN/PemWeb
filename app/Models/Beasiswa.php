<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $table = 'beasiswas';
    
    protected $fillable = [
        'nama',
        'jurusan',
        'universitas',
        'status',
        'jenjang',
        'ipk_minimal',
        'deskripsi',
        'gambar',
        'is_popular',
        'deadline'
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_popular' => 'boolean',
        'ipk_minimal' => 'decimal:2'
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
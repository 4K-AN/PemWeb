<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_beasiswa',
        'deskripsi',
        'universitas',
        'jenis_beasiswa',
        'jenjang',
        'kategori',
        'negara',
        'status',
        'deadline',
        'ipk_minimal',
        'benefit_biaya_kuliah',
        'benefit_biaya_hidup',
        'benefit_tiket_pesawat',
        'benefit_asuransi',
        'link_pendaftaran',
        'gambar'
    ];

    protected $casts = [
        'deadline' => 'date',
        'ipk_minimal' => 'decimal:2',
        'benefit_biaya_kuliah' => 'boolean',
        'benefit_biaya_hidup' => 'boolean',
        'benefit_tiket_pesawat' => 'boolean',
        'benefit_asuransi' => 'boolean',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifSmart extends Model
{
    use HasFactory;

     protected $fillable = [
        'kode',
        'nama',
        'email',
        'telepon',
        'alamat',
        'jabatan',
        'tahun_masuk',
        'status',
        'created_by',
    ];

    protected $casts = [
        'tahun_masuk' => 'integer',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function penilaianSmarts()
    {
        return $this->hasMany(PenilaianSmart::class);
    }

    public function hasilAkhirSmarts()
    {
        return $this->hasMany(HasilAkhirSmart::class);
    }

    // Scope hanya alternatif aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function historyRankingSmarts()
    {
        return $this->hasMany(HistoryRankingSmart::class);
    }

    
}

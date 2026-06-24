<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeSmart extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulan',
        'tahun',
        'status',
        'created_by',
    ];

    protected $casts = [
        'bulan' => 'integer',
        'tahun' => 'integer',
    ];

    // Accessor nama bulan
    public function getNamaBulanAttribute(): string
    {
        $bulanList = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];
        return $bulanList[$this->bulan] ?? '-';
    }

    // Accessor label lengkap
    public function getLabelAttribute(): string
    {
        return $this->nama_bulan . ' ' . $this->tahun;
    }

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

    public function historyRankingSmarts()
    {
        return $this->hasMany(HistoryRankingSmart::class);
    }
}

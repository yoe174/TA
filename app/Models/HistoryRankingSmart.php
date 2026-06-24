<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryRankingSmart extends Model
{
     use HasFactory;

    protected $fillable = [
        'periode_smart_id',
        'alternatif_terbaik_id',
        'nilai_terbaik',
        'status',
        'keterangan',
        'detail_snapshot',
        'created_by',
    ];

    protected $casts = [
        'nilai_terbaik'   => 'decimal:6',
        'detail_snapshot' => 'array',
    ];

    public function periodeSmart()
    {
        return $this->belongsTo(PeriodeSmart::class);
    }

    public function alternatifTerbaik()
    {
        return $this->belongsTo(AlternatifSmart::class, 'alternatif_terbaik_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

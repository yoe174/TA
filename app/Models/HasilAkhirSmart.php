<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilAkhirSmart extends Model
{
    use HasFactory;

    protected $fillable = [
        'periode_smart_id',
        'alternatif_smart_id',
        'nilai_total',
        'rangking',
    ];

    protected $casts = [
        'nilai_total' => 'decimal:6',
        'rangking'    => 'integer',
    ];

    public function periodeSmart()
    {
        return $this->belongsTo(PeriodeSmart::class);
    }

    public function alternatifSmart()
    {
        return $this->belongsTo(AlternatifSmart::class);
    }
}

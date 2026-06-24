<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilUtilitasSmart extends Model
{
    use HasFactory;

    protected $fillable = [
        'periode_smart_id',
        'alternatif_smart_id',
        'criteria_smart_id',
        'nilai_aktual',
        'nilai_min',
        'nilai_max',
        'nilai_utilitas',
    ];

    protected $casts = [
        'nilai_aktual'   => 'decimal:4',
        'nilai_min'      => 'decimal:4',
        'nilai_max'      => 'decimal:4',
        'nilai_utilitas' => 'decimal:6',
    ];

    public function periodeSmart()
    {
        return $this->belongsTo(PeriodeSmart::class);
    }

    public function alternatifSmart()
    {
        return $this->belongsTo(AlternatifSmart::class);
    }

    public function criteriaSmart()
    {
        return $this->belongsTo(CriteriaSmart::class);
    }
}

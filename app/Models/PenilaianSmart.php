<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSmart extends Model
{
    use HasFactory;

    protected $fillable = [
        'periode_smart_id',
        'alternatif_smart_id',
        'criteria_smart_id',
        'parameter_smart_id',
        'nilai_manual',
        'created_by',
    ];

    protected $casts = [
        'nilai_manual' => 'decimal:2',
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

    public function parameterSmart()
    {
        return $this->belongsTo(ParameterSmart::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Ambil nilai aktual (dari parameter atau manual)
    public function getNilaiAktualAttribute(): float
    {
        if ($this->parameter_smart_id && $this->parameterSmart) {
            return (float) $this->parameterSmart->nilai;
        }
        return (float) $this->nilai_manual;
    }
}

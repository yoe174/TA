<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterSmart extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_smart_id',
        'label',
        'nilai',
    ];

    protected $casts = [
        'nilai' => 'integer',
    ];

    public function criteriaSmart()
    {
        return $this->belongsTo(CriteriaSmart::class);
    }

    // public function penilaianSmarts()
    // {
    //     return $this->hasMany(PenilaianSmart::class);
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriteriaFinal extends Model
{
    protected $table = 'criteria_finals';
   
    protected $fillable = [
        'criteria_ahp_id',
        'kode',
        'nama_kriteria',
        'jenis',
        'bobot',
        'ri',
        'cr',
        'is_consistent',
    ];

    protected $casts = [
        'bobot'         => 'decimal:6',
        'ri'            => 'decimal:6',
        'cr'            => 'decimal:6',
        'is_consistent' => 'boolean',
    ];

    // Relasi ke criterias (referensi saja)
    public function criteria()
    {
        return $this->belongsTo(CriteriaAHP::class);
    }

    // Relasi ke smart_criterias nanti
    // public function smartCriterias()
    // {
    //     return $this->hasMany(SmartCriteri::class);
    // }
}

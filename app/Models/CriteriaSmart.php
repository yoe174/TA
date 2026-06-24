<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use Illuminate\Database\Eloquent\Factories\HasFactory;

class CriteriaSmart extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama_kriteria',
        'jenis',
        'bobot',
        'use_parameter',
        'created_by',
    ];

    protected $casts = [
        'bobot'         => 'decimal:6',
        'use_parameter' => 'boolean',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function parameters()
    {
        return $this->hasMany(ParameterSmart::class);
    }

    public function penilaianSmarts()
    {
        return $this->hasMany(PenilaianSmart::class);
    }
}

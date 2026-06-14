<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriteriaAHP extends Model
{
    protected $table = 'criteria_ahp';

    protected $fillable = [
        'nama_kriteria',
        'kode',
        'jenis',
    ];

    public function comparisonFrom()
    {
        return $this->hasMany(ComparisonMatrixAhp::class, 'criteria_id_from');
    }

    public function comparisonTo()
    {
        return $this->hasMany(ComparisonMatrixAhp::class, 'criteria_id_to');
    }


}

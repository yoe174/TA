<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class NormalizationMatrixAhp extends Model
{

    protected $table = 'normalization_matrix_ahp';
    
    protected $fillable = [
        'criteria_id_from',
        'criteria_id_to',
        'normalized_value',
        'priority_vector',
    ];

    protected $casts = [
        'normalized_value' => 'decimal:6',
        'priority_vector'  => 'decimal:6',
    ];

    public function criteriaFrom()
    {
        return $this->belongsTo(CriteriaAHP::class, 'criteria_id_from');
    }

    public function criteriaTo()
    {
        return $this->belongsTo(CriteriaAHP::class, 'criteria_id_to');
    }
}

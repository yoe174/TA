<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\Csv\Query\Constraint\Criteria;

class ComparisonMatrixAhp extends Model
{
    protected $table = 'comparison_matrix_ahp';

    protected $fillable = [
        'criteria_id_from',
        'criteria_id_to',
        'value',
    ];

    public function criteriaFrom()
    {
        return $this->belongsTo(CriteriaAHP::class, 'criteria_id_from');
    }

    public function criteriaTo()
    {
        return $this->belongsTo(CriteriaAHP::class, 'criteria_id_to');
    }

    protected static function booted(): void
{
    static::saving(function ($model) {
        // Paksa nilai diagonal selalu 1
        if ($model->criteria_id_from === $model->criteria_id_to) {
            $model->value = 1;
        }
    });
}
}

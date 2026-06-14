<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeightAhpResult extends Model
{
    protected $fillable = [
        'criteria_ahp_id',
        'bobot',
        'lambda_max',
        'ri',
        'ci',
        'cr',
        'is_consistent',
    ];

    protected $casts = [
        'bobot'         => 'decimal:6',
        'lambda_max'    => 'decimal:6',
        'ri'            => 'decimal:6',
        'ci'            => 'decimal:6',
        'cr'            => 'decimal:6',
        'is_consistent' => 'boolean',
    ];

    public function criteria()
    {
        return $this->belongsTo(CriteriaAHP::class, 'criteria_ahp_id');
    }
}

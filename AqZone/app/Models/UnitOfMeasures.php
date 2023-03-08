<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitOfMeasures extends Model
{
    use HasFactory;

    protected $primaryKey = 'unit_of_measure_id';

    protected $fillable = [
        'unitOfMeasureName',
        'unitOfMeasureLinkingMultiplicator'
    ];
}

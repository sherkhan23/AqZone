<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosage extends Model
{

    protected $primaryKey = 'dosage_id';
    use HasFactory;

    protected $fillable = [
        'dosage_id',
        'aids_id',
        'aid_component_id',
        'unit_of_measure_id',
        'dosage'
    ];
}

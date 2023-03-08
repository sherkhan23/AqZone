<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HazardObjects extends Model
{
    use HasFactory;

    protected $primaryKey = 'hazard_id';
    protected $fillable = [
        'hazardName',
    ];

    public function utilNorms()
    {
        return $this->belongsTo(AidsUtilizationNorms::class, 'hazard_id', 'hazard_id');
    }
}

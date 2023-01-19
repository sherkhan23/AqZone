<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HazardObjects extends Model
{
    use HasFactory;

    public function aidUtilNorm(){
        return $this->belongsToMany(AidsUtilizationNorms::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cultures extends Model
{
    use HasFactory;

    public function aidsUtilNorm(){
        return $this->belongsTo(AidsUtilizationNorms::class);
    }
}

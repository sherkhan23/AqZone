<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cultures extends Model
{
    use HasFactory;

    protected $primaryKey = 'culture_id';
    public function aidsUtilNorm(){
        return $this->belongsTo(AidsUtilizationNorms::class);
    }

    protected $fillable = [
        'cultureName',
    ];

    public function utilNorms()
    {
        return $this->belongsTo(AidsUtilizationNorms::class, 'culture_id', 'culture_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Cart extends Model
{
    use HasFactory;

    protected $primaryKey = 'cart_id';
    protected $foreignKey = 'aids_id';


    protected $fillable = [
        'user_id',
        'aids_id',
        'quantity',
        'user_culture',
        'user_culture_util_norm',
        'user_culture_square'
    ];
}

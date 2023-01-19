<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_cultures extends Model
{
    use HasFactory;
    protected $primaryKey = 'userCult_id';

    protected $fillable = [
        'user_id',
        'culture_id',
        'square',
        'yearSowing',
    ];
}

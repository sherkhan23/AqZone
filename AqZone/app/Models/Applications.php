<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    use HasFactory;

    protected $primaryKey = 'app_id';

    protected $fillable = [
        'application_id',
        'aids_id',
        'culture_name',
        "user_culture_util_norm",
        "user_culture_square",
    ];
}

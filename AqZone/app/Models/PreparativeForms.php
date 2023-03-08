<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreparativeForms extends Model
{

    protected $fillable = [
        'prepFormName',
        'prepFormShortName'
    ];
    use HasFactory;
}

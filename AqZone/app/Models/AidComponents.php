<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AidComponents extends Model
{
    use HasFactory;

    protected $primaryKey = 'aid_component_id';

    protected $fillable = [
        'componentName',
        'unit_of_measures_id',
        'preparative_forms_id'
    ];
}

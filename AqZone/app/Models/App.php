<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    protected $primaryKey = 'application_id';

    protected $fillable = [
        'user_id',
        'delivery_type',
        'city_id',
        'user_location_id',
        'payment_type',
        'pre_pay',
        'message',
        'app_status',
        'delivery_date',
        'postponement'
    ];
}

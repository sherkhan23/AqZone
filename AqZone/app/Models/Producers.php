<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producers extends Model
{
    use HasFactory;

    protected $primaryKey = 'producer_id';

    protected $fillable = [
        'ProducerName',
        'producerCountry',
        'brand_id'
    ];
}

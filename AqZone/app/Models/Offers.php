<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    use HasFactory;

    protected $primaryKey = 'offer_id';
    protected $foreignKey = 'publication_id';

    protected $fillable = [
        'publication_id',
        'user_offer_id',
        'offer_status',
    ];
}

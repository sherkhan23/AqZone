<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferData extends Model
{
    use HasFactory;
    use HasFactory;
    protected $primaryKey = 'offer_data_id';

    protected $fillable = [
        'offer_collect',
        'aids_id',
        'cultureNameOffer',
        'user_culture_square',
        'user_culture_util_norm',
        'requiredQuantity',
        'offerQuantity',
        'offerSumNDS',
        'sumNDS',
        'minOfferPrice'
    ];
}

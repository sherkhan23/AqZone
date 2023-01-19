<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class);
    }

    protected $primaryKey = 'loc_id';

    protected $fillable = [
        'user_id',
        'country_id',
        'region_id',
        'subregion_id',
        'locality_id',
        'address',
        'comment',
        'status'
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AidsUtilizationNorms extends Model
{
    use HasFactory;

    public function AidsUtilizationNorms(Request $request){
        $aidsUtilizationNorms = AidsUtilizationNorms::query();
        $aidsUtilNorms = $aidsUtilizationNorms->join('aids', function ($join) {
            $join->on('aids_utilization_norms.aids_id', '=', 'aids.aids_id');
        })->paginate();

    }

    public function aids(){
        return $this->belongsToMany(Aids::class);
    }

    public function cultures(){
        return $this->hasMany(Cultures::class);
    }

    public function hazard(){
        return $this->hasMany(HazardObjects::class);
    }

}

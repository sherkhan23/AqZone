<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AidsUtilizationNorms extends Model
{
    use HasFactory;

    protected $primaryKey = 'util_norm_id';
    protected $fillable = [
        'culture_id',
        'aids_id',
        'register_date',
        'minUtilizationRate',
        'maxUtilizationRate',
        'utilizationRate',
        'utilizationRateComment',
        'finalApplicationTerms',
        'min_multiplicity',
        'max_multiplicity',
        'hazard_id',
    ];

    public function AidsUtilizationNorms(Request $request){
        $aidsUtilizationNorms = AidsUtilizationNorms::query();
        $aidsUtilNorms = $aidsUtilizationNorms->join('aids', function ($join) {
            $join->on('aids_utilization_norms.aids_id', '=', 'aids.aids_id');
        })->paginate();

    }

    public function aids()
    {
        return $this->belongsTo(Aids::class, 'aids_id', 'aids_id');
    }

    public function cultures(){
        return $this->hasMany(Cultures::class);
    }

    public function hazard(){
        return $this->hasMany(HazardObjects::class);
    }

}

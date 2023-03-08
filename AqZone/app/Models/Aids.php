<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use PhpParser\Builder\Class_;

class Aids extends Model
{
    use HasFactory;

    protected $primaryKey = 'aids_id';

    protected $fillable = [
        'aidName',
        "category_id",
        "preparative_forms_id",
        "aid_components_id",
        "packs",
        "producer_id",
        "brand_id",
        "registrationEndDate",
        'created_at'
    ];

    public function cetegories()
    {
        return $this->hasMany(Categories::class);
    }

    public function brands()
    {
        return $this->hasMany(Brands::class);
    }

    public function aidsUtilNorm(){
        return $this->hasMany(AidsUtilizationNorms::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter){
        return $filter->apply($builder);
    }

}

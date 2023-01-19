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

    public function categories()
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

<?php

namespace App\Filters;
use App\Models\Brands;
use Illuminate\Support\Facades\DB;
use App\Models\Aids;

class AidFilter extends QueryFilter{


    public function brandFilter($aid_id){

        return $this->builder->where('aids.brand_id', $aid_id);
    }

    public function categoryFilter($aid_id){
        return $this->builder->where('aids.category_id', $aid_id );
    }

    public function producerFilter($aid_id){
        return $this->builder->where('aids.producer_id', $aid_id );
    }

    public function preparativeFormsFilter($aid_id){
        return $this->builder->where('aids.preparative_forms_id', $aid_id );
    }


    public function cultureFilter($aid_id){
        return $this->builder->where('aids_utilization_norms.culture_id', $aid_id );

//        return $this->builder->whereHas('aids_utilization_norm_id', function($q) use ($aid_id) {
//          $q->where('culture_id', $aid_id);
//        });
    }

    public function hazardFilter($aid_id){
        return $this->builder->where('aids_utilization_norms.hazard_id', $aid_id );
    }

}

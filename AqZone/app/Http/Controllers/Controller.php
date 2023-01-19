<?php

namespace App\Http\Controllers;

use App\Models\Aids;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function mainPage()
    {
        $aidQuery = Aids::query();
        Paginator::useBootstrap();

        $aids = $aidQuery
            ->leftJoin('categories', function ($join) {
                $join->on('aids.category_id', '=', 'categories.id');
            })
            ->leftJoin('preparative_forms', function ($join) {
                $join->on('aids.preparative_forms_id', '=', 'preparative_forms.id');
            })->leftJoin('producers', function ($join) {
                $join->on('aids.producer_id', '=', 'producers.id');
            })
            ->leftJoin('brands', function ($join) {
                $join->on('aids.brand_id', '=', 'brands.id');
            })
            ->leftJoin('aid_components', function ($join) {
                $join->on('aids.aid_components_id', '=', 'aid_components.id');
            })
            ->leftJoin('aids_utilization_norms', function ($join) {
                $join->on('aids.aids_utilization_norm_id', '=', 'aids_utilization_norms.util_norm_id')

                    ->leftJoin('cultures', function ($join) {
                        $join->on('aids_utilization_norms.culture_id', '=', 'cultures.id');

                    })->leftJoin('hazard_objects', function ($join) {
                        $join->on('aids_utilization_norms.hazard_id', '=', 'hazard_objects.id');
                    });
            })
            ->paginate();

        return view('home', compact('aids'));
    }

}

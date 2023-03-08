<?php

namespace App\Http\Controllers;

use App\Filters\AidFilter;
use App\Models\Aids;
use App\Models\AidsUtilizationNorms;
use App\Models\App;
use App\Models\Applications;
use App\Models\Brands;
use App\Models\Cart;
use App\Models\Categories;
use App\Models\Cultures;
use App\Models\Dosage;
use App\Models\HazardObjects;
use App\Models\PreparativeForms;
use App\Models\Producers;
use App\Models\User;
use App\Models\User_cultures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class AidsController extends Controller
{
    public function Aids(Request $request, AidFilter $filter){

        $aidQuery = Aids::query();
        Paginator::useBootstrap();

        if ($request->filled('search_field')){
            $aidQuery->where('aidName', 'LIKE', '%'.$request->search_field.'%');
        }

        $aids = $aidQuery
            ->leftJoin('categories', function ($join) {
                $join->on('aids.category_id', '=', 'categories.id');
            })
            ->leftJoin('preparative_forms', function ($join) {
                $join->on('aids.preparative_forms_id', '=', 'preparative_forms.id');
            })->leftJoin('producers', function ($join) {
                $join->on('aids.producer_id', '=', 'producers.producer_id');
            })
            ->leftJoin('brands', function ($join) {
                $join->on('aids.brand_id', '=', 'brands.id');
            })
            ->leftJoin('aid_components', function ($join) {
                $join->on('aids.aid_components_id', '=', 'aid_components.aid_component_id');
            })

            ->filter($filter)
            ->orderBy('aids_id', 'desc')
            ->paginate(4);

        $aids_util_norms = AidsUtilizationNorms::query()
                ->leftJoin('cultures', function ($join) {
                    $join->on('aids_utilization_norms.culture_id', '=', 'cultures.culture_id');
                })->leftJoin('hazard_objects', function ($join) {
                    $join->on('aids_utilization_norms.hazard_id', '=', 'hazard_objects.hazard_id');
        })->get();


        $carts = Cart::query()->paginate();


        if (Auth::user() == true) {
            $cartCounter = \Illuminate\Support\Facades\DB::table('carts')
                ->having('user_id', '=', \Illuminate\Support\Facades\Auth::user()->user_id)
                ->groupBy('cart_id')
                ->get()->count();

            $appCounter = App::query()
                ->having('user_id', '=', \Illuminate\Support\Facades\Auth::user()->user_id)
                ->groupBy('application_id')
                ->get()->count();


            $userCultures = User_cultures::query();

            $userCulture = $userCultures
                ->leftJoin('users', function ($join) {
                    $join->on('user_cultures.user_id', '=', 'users.user_id');
                })
                ->leftJoin('cultures', function ($join) {
                    $join->on('user_cultures.culture_id', '=', 'cultures.culture_id');
                })
                ->paginate();

            $user_cult = Cultures::query()->get();
            $addCartRemove = Cart::query()->get();

            return view('catalog', compact('aids', 'carts', 'userCulture', 'cartCounter',
                'appCounter', 'user_cult', 'addCartRemove', 'aids_util_norms'));
        }
        else{
            return view('catalog', compact('aids'));
        }
    }

    public function getAids($aids_id){

        $aidItem = Aids::query()->where('aids_id', $aids_id)
            ->leftJoin('categories', function ($join) {
                $join->on('aids.category_id', '=', 'categories.id');
            })
            ->leftJoin('preparative_forms', function ($join) {
                $join->on('aids.preparative_forms_id', '=', 'preparative_forms.id');
            })->leftJoin('producers', function ($join) {
                $join->on('aids.producer_id', '=', 'producers.producer_id');
            })
            ->leftJoin('brands', function ($join) {
                $join->on('aids.brand_id', '=', 'brands.id');
            })
            ->leftJoin('aid_components', function ($join) {
                $join->on('aids.aid_components_id', '=', 'aid_components.aid_component_id');
            })
            ->first();

        $aids_util_norms = AidsUtilizationNorms::query()
            ->leftJoin('cultures', function ($join) {
                $join->on('aids_utilization_norms.culture_id', '=', 'cultures.culture_id');
            })->leftJoin('hazard_objects', function ($join) {
                $join->on('aids_utilization_norms.hazard_id', '=', 'hazard_objects.hazard_id');
            })->get();

        $dosages = Dosage::query()
            ->leftJoin('aids', function ($join) {
                $join->on('dosages.aids_id', '=', 'aids.aids_id');
            })->leftJoin('aid_components', function ($join) {
                $join->on('dosages.aid_component_id', '=', 'aid_components.aid_component_id');
            })->leftJoin('unit_of_measures', function ($join) {
                $join->on('dosages.unit_of_measure_id', '=', 'unit_of_measures.unit_of_measure_id');
            })->get();

        $cultureCount = 0;
        $cultureHazardCount = 0;
        return view('showAids', compact( 'aidItem', 'aids_util_norms', 'cultureCount'
        , 'cultureHazardCount', 'dosages'));
    }

    public function showApplications(){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aids  $aids
     * @return \Illuminate\Http\Response
     */
    public function show(Aids $aids)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aids  $aids
     * @return \Illuminate\Http\Response
     */
    public function edit(Aids $aids)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aids  $aids
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aids $aids)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aids  $aids
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aids $aids)
    {
        //
    }
}

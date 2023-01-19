<?php

namespace App\Http\Controllers;

use App\Models\Aids;
use App\Models\App;
use App\Models\Applications;
use App\Models\Cart;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Locations;
use App\Models\User;
use App\Models\User_culture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function cart(){
        $cart = Cart::query();

        $carts = $cart
            ->leftJoin('aids', function ($join) {
                $join->on('carts.aids_id', '=', 'aids.aids_id')
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

                            ->leftJoin('unit_of_measures', function ($join) {
                                $join->on('aids_utilization_norms.unit_of_measure_id', '=', 'unit_of_measures.unit_of_measure_id');

                            })
                            ->leftJoin('cultures', function ($join) {
                                $join->on('aids_utilization_norms.culture_id', '=', 'cultures.id');

                            })->leftJoin('hazard_objects', function ($join) {
                                $join->on('aids_utilization_norms.hazard_id', '=', 'hazard_objects.id');
                            });
                    });
            })
            ->paginate();
        $aidQuery = Aids::query();


        $cartCounter = \Illuminate\Support\Facades\DB::table('carts')
            ->having('user_id', '=', \Illuminate\Support\Facades\Auth::user()->user_id)
            ->groupBy('cart_id')
            ->get()->count();

        $appCounter = App::query()
            ->having('user_id', '=', \Illuminate\Support\Facades\Auth::user()->user_id)
            ->groupBy('application_id')
            ->get()->count();

        $user_locations = Locations::all();
        $cities = Cities::all();
        $countries = Countries::all();

        return view('inc.cart', compact(  'carts', 'user_locations', 'cartCounter',
            'cities', 'appCounter', 'countries'));

    }


    public function update_cart(Request $request, $aids_id){

        if ($request->get('user_culture') == 'default-culture' and
            $request['user_square'] == true){
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'aids_id' => $request['aids_id'],
                'quantity' => 1,
                'user_culture' => $request->get('user-default-culture'),
                'user_culture_util_norm' => $request->get('aidsUtilizationRate'),
                'user_culture_square' => $request['user_square']
            ]);
        }
        elseif ($request->get('user_culture') == 'default-culture' and
            $request['user_square'] == false){
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'aids_id' => $request['aids_id'],
                'quantity' => 1,
                'user_culture' => $request->get('user-default-culture'),
                'user_culture_util_norm' => $request->get('aidsUtilizationRate'),
                'user_culture_square' => 0
            ]);
        }
        elseif ($request->get('user_culture') == 'other-culture'){
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'aids_id' => $request['aids_id'],
                'quantity' => 1,
                'user_culture' => $request['other-user_culture'],
                'user_culture_util_norm' => $request->get('aidsUtilizationRate'),
                'user_culture_square' =>  0
            ]);
        }



        return redirect()->back()->with('successAddCart', 'Успешно добвалено, посмотрите корзинку');

    }



    public function delCart($cart_id){
        Cart::find($cart_id)->delete();
        return redirect()->back()->with('successDelCart', 'Успешно удалено');
    }

    public function eachCart($cart_id){
        $cart = Cart::query()->where('cart_id', $cart_id)->join('categories', function ($join) {
            $join->on('aids.category_id', '=', 'categories.id');
        })
            ->join('preparative_forms', function ($join) {
                $join->on('aids.preparative_forms_id', '=', 'preparative_forms.id');
            })
            ->join('producers', function ($join) {
                $join->on('aids.producer_id', '=', 'producers.id');
            })
            ->join('brands', function ($join) {
                $join->on('aids.brand_id', '=', 'brands.id');
            })
            ->join('aid_components', function ($join) {
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
            ->first();
    }

    public function updateUtilNorm(Request $request, $cart_id){
        $updateUtilNorm = Cart::find($cart_id);
        $validated = $request->validate([
            "user_culture_util_norm" => ["numeric"],
        ]);
        if ($request['user_culture_util_norm'] <= 0){
            return redirect()->back()->with('errorUtilNorm', 'Норма рассхода должен быть больше 0');
        }
        $updateUtilNorm->user_culture_util_norm = $request['user_culture_util_norm'];
        $updateUtilNorm->save();

        return redirect()->back()->with('updateMess','Успешно сохранено');

    }


    public function updateSquare(Request $request, $cart_id){
        $updateSquare = Cart::find($cart_id);
        $validated = $request->validate([
            "user_culture_square" => ["numeric"],
        ]);
        if ($updateSquare){
            if ($request->get('user_culture_square') <= 0){
                return redirect()->back()->with('errorSquare', 'Площадь должен быть больше 0');
            }
            $updateSquare->user_culture_square = $request->get('user_culture_square');
            $updateSquare->save();
            return redirect()->back()->with('updateMessSquare','Площадь успешно сохранено');
        }else{
            return redirect()->back();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
    }

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
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}

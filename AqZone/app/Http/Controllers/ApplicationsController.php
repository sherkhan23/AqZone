<?php

namespace App\Http\Controllers;
use App\Models\App;
use App\Models\Cities;
use App\Models\Locations;
use App\Models\OfferData;
use App\Models\Offers;
use Illuminate\Support\Facades\Validator;
use App\Models\Applications;
use App\Models\Cart;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicationsController extends Controller
{

    public function applications(){
        $cartCounter = \Illuminate\Support\Facades\DB::table('carts')
            ->having('user_id', '=', \Illuminate\Support\Facades\Auth::user()->user_id)
            ->groupBy('cart_id')
            ->get()->count();

        $appCounter = App::query()
            ->having('user_id', '=', \Illuminate\Support\Facades\Auth::user()->user_id)
            ->groupBy('application_id')
            ->get()->count();

        $apps = Applications::query();

        $app = $apps
            ->join('apps', function ($join) {
                $join->on('applications.application_id', '=', 'apps.application_id')
                    ->leftJoin('cities', function ($join) {
                        $join->on('apps.city_id', '=', 'cities.id');
                    })
                    ->leftJoin('locations', function ($join) {
                        $join->on('apps.user_location_id', '=', 'locations.loc_id')
                            ->join('countries', function ($join) {
                                $join->on('locations.country_id', '=', 'countries.id');
                            })
                            ->join('localities', function ($join) {
                                $join->on('locations.locality_id', '=', 'localities.id');
                            })
                            ->join('regions', function ($join) {
                                $join->on('locations.region_id', '=', 'regions.id');
                            })
                            ->join('subregions', function ($join) {
                                $join->on('locations.subregion_id', '=', 'subregions.id');
                            });
                    })
                    ->join('users', function ($join) {
                        $join->on('apps.user_id', '=', 'users.user_id');
                    });
            })
            ->join('aids', function ($join) {
                $join->on('applications.aids_id', '=', 'aids.aids_id')
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

                    });
            })
            ->orderBy('applications.application_id', 'desc')
            ->get();

        $viewCollect =  collect($app)
            ->groupBy('application_id');

        # end collection applications

        $cities = Cities::all();
        $user_locations = Locations::all();


        # offer collection
        $offer = OfferData::query();
        $offers = $offer
            ->join('aids', function ($join) {
                $join->on('offer_data.aids_id', '=', 'aids.aids_id')

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
                    });
            })
            ->join('offers', function ($join) {
                $join->on('offer_data.offer_collect', '=', 'offers.offer_id')

                    ->join('apps', function ($join) {
                        $join->on('offers.publication_id', '=', 'apps.application_id')
                            ->leftJoin('cities', function ($join) {
                                $join->on('apps.city_id', '=', 'cities.id');
                            })
                            ->join('locations', function ($join) {
                                $join->on('apps.user_location_id', '=', 'locations.loc_id')
                                    ->join('countries', function ($join) {
                                        $join->on('locations.country_id', '=', 'countries.id');
                                    })
                                    ->join('localities', function ($join) {
                                        $join->on('locations.locality_id', '=', 'localities.id');
                                    })
                                    ->join('regions', function ($join) {
                                        $join->on('locations.region_id', '=', 'regions.id');
                                    })
                                    ->join('subregions', function ($join) {
                                        $join->on('locations.subregion_id', '=', 'subregions.id');
                                    });
                            })
                            ->join('users', function ($join) {
                                $join->on('apps.user_id', '=', 'users.user_id');
                            });
                    });
            })
            ->orderBy('offers.created_at', 'desc')
            ->get();

        $offersCollect = collect($offers)
            ->groupBy('offer_collect');

        $offersCollectForAnalysis = collect($offers)
            ->groupBy('publication_id');


        # offer collection

        $offerCountSeller = \Illuminate\Support\Facades\DB::table('offers')
            ->having('user_offer_id', '=', \Illuminate\Support\Facades\Auth::user()->user_id)
            ->groupBy('offer_id')
            ->where('offer_status', '=', 'consideration')
            ->get()->count();

        $draftCountSeller = \Illuminate\Support\Facades\DB::table('offers')
            ->having('user_offer_id', '=', \Illuminate\Support\Facades\Auth::user()->user_id)
            ->groupBy('offer_id')
            ->where('offer_status', '=', 'draft')
            ->get()->count();

        $offerCount = \Illuminate\Support\Facades\DB::table('offers')
            ->leftJoin('apps', function ($join) {
                $join->on('offers.publication_id', '=', 'apps.application_id');
            })
            ->where('user_id', '=', \auth()->id())
            ->where('app_status', '=', 'published')
            ->groupBy('offer_id', 'application_id')->get()->count();

        $draftCount = \Illuminate\Support\Facades\DB::table('apps')
            ->where('user_id', '=', \auth()->id())
            ->where('app_status', '=', 'draft')
            ->groupBy('application_id')->get()->count();


        $sumNds = OfferData::all();

        $offers = Offers::query()->where('user_offer_id', '=', \auth()->id())->get();

        return view('applications', compact('cartCounter', 'apps', 'appCounter', 'viewCollect',
            'cities', 'user_locations', 'offersCollect', 'offerCount', 'offerCountSeller', 'offersCollectForAnalysis',
            'sumNds', 'offers', 'draftCount', 'draftCountSeller'));
    }



    public function getApplication ($application_id){
        $application = Applications::query()->where('application_id', $application_id)
            ->leftJoin('apps', function ($join) {
                $join->on('applications.application_id', '=', 'apps.application_id');
            })
            ->leftJoin('cities', function ($join) {
                $join->on('applications.city_id', '=', 'cities.id');
            })
            ->leftJoin('users', function ($join) {
                $join->on('applications.user_id', '=', 'users.user_id');
            })
            ->join('aids', function ($join) {
                $join->on('applications.aids_id', '=', 'aids.aids_id')
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

                    });
            })
            ->first();


        return view('application.application', compact( 'application'));
    }


    public function addApplication(Request $request)
    {
        $cart = Cart::query()->get();
        $getCart = $cart;

        $validated = $request->validate([
            "delivery_type" => ["required"],
            "payment_type" => ["required"],
        ]);

        if ($request['delivery_type'] == 'selfCall' and $request['payment_type'] == 'payfull') {
            $validated = $request->validate([
                'city_id' => ["required"]
            ]);
            $application = App::create([
                'user_id' => Auth::id(),
                'delivery_type' => $request['delivery_type'],
                'city_id' => $request['city_id'],
                'user_location_id' => 71,
                'payment_type' => $request['payment_type'],
                'pre_pay' => $request['pre_pay'],
                'message' => $request->get('message'),
                "app_status" => "published",
                'delivery_date' => $request['delivery_date'],
                'postponement' => $request['postponement']
            ]);

            foreach ($getCart as $cart){
                if ($cart->user_id == Auth::id()) {
                    if ($cart->aids_id == null){
                        return redirect()->back()->with('errorNull', 'Корзина пустая');
                    }

                    else{
                        if ( $cart->user_culture_square <= 0){
                            return redirect()->back()->with('errorSquare', 'Площадь должен быть больше 0');
                        }
                        elseif ($cart->user_culture_util_norm <= 0){
                            return redirect()->back()->with('errorUtilNorm', 'Норма рассхода должен быть больше 0');
                        }
                        else{
                            $validated = $request->validate([
                                "user_culture_util_norm" => ["numeric"],
                                "user_culture_square" => ["numeric"]
                            ]);
                            $cart = Applications::create([
                                'application_id' => $application['application_id'],
                                'aids_id' => $cart->aids_id,
                                'culture_name' => $cart->user_culture,
                                "user_culture_util_norm" => $cart->user_culture_util_norm,
                                "user_culture_square" => $cart->user_culture_square,
                            ]);
                        }
                        \Illuminate\Support\Facades\DB::table('carts')
                            ->where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->user_id)
                            ->delete();
                    }
                }
            }


        } else if ($request['delivery_type'] == 'selfCall' and $request['payment_type'] == 'pre_pay') {
            if ($request['pre_pay'] >= 100 || $request['pre_pay'] <= 0 ) {
                return redirect()->back()->with('errorPrePay', 'Предоплата должен быть не менее 0 и больше 100');
            } else {
                $validated = $request->validate([
                    'city_id' => ["required"],
                    'pre_pay' => ['required']
                ]);
                $application = App::create([
                    'user_id' => Auth::id(),
                    'delivery_type' => $request['delivery_type'],
                    'city_id' => $request['city_id'],
                    'user_location_id' => 71,
                    'payment_type' => $request['payment_type'],
                    'pre_pay' => $request['pre_pay'],
                    'message' => $request->get('message'),
                    "app_status" => "published",
                    'delivery_date' => $request['delivery_date'],
                    'postponement' => $request['postponement']
                ]);
                foreach ($getCart as $cart) {
                    if ($cart->user_id == Auth::id()) {
                        if ($cart->aids_id == null) {
                            return redirect()->back()->with('errorNull', 'Корзина пустая');
                        } else {
                            if ($cart->user_culture_square <= 0) {
                                return redirect()->back()->with('errorSquare', 'Площадь должен быть больше 0');
                            } elseif ($cart->user_culture_util_norm <= 0) {
                                return redirect()->back()->with('errorUtilNorm', 'Норма рассхода должен быть больше 0');
                            } else {
                                $validated = $request->validate([
                                    "user_culture_util_norm" => ["numeric"],
                                    "user_culture_square" => ["numeric"]
                                ]);
                                $cart = Applications::create([
                                    'application_id' => $application['application_id'],
                                    'aids_id' => $cart->aids_id,
                                    'culture_name' => $cart->user_culture,
                                    "user_culture_util_norm" => $cart->user_culture_util_norm,
                                    "user_culture_square" => $cart->user_culture_square,
                                ]);
                            }
                            \Illuminate\Support\Facades\DB::table('carts')
                                ->where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->user_id)
                                ->delete();
                        }
                    }
                }
            }
        } else if ($request['delivery_type'] == 'delivery' and $request['payment_type'] == 'pre_pay') {
            if ($request['pre_pay'] >= 100 || $request['pre_pay'] <= 0 ) {
                return redirect()->back()->with('errorPrePay', 'Предоплата должен быть не менее 0 и больше 100');
            } else {
                $validated = $request->validate([
                    'user_location_id' => ["required"],
                    'pre_pay' => ['required']
                ]);
                $application = App::create([
                    'user_id' => Auth::id(),
                    'delivery_type' => $request['delivery_type'],
                    'city_id' => 1,
                    'user_location_id' => $request['user_location_id'],
                    'payment_type' => $request['payment_type'],
                    'pre_pay' => $request['pre_pay'],
                    'message' => $request->get('message'),
                    "app_status" => "published",
                    'delivery_date' => $request['delivery_date'],
                    'postponement' => $request['postponement']
                ]);
                foreach ($getCart as $cart){
                    if ($cart->user_id == Auth::id()) {
                        if ($cart->aids_id == null){
                            return redirect()->back()->with('errorNull', 'Корзина пустая');
                        }

                        else{
                            if ( $cart->user_culture_square <= 0){
                                return redirect()->back()->with('errorSquare', 'Площадь должен быть больше 0');
                            }
                            elseif ($cart->user_culture_util_norm <= 0){
                                return redirect()->back()->with('errorUtilNorm', 'Норма рассхода должен быть больше 0');
                            }
                            else{
                                $validated = $request->validate([
                                    "user_culture_util_norm" => ["numeric"],
                                    "user_culture_square" => ["numeric"]
                                ]);
                                $cart = Applications::create([
                                    'application_id' => $application['application_id'],
                                    'aids_id' => $cart->aids_id,
                                    'culture_name' => $cart->user_culture,
                                    "user_culture_util_norm" => $cart->user_culture_util_norm,
                                    "user_culture_square" => $cart->user_culture_square,
                                ]);
                            }
                            \Illuminate\Support\Facades\DB::table('carts')
                                ->where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->user_id)
                                ->delete();
                        }
                    }
                }
            }
        }
        else if ($request['delivery_type'] == 'delivery' and $request['payment_type'] == 'payfull') {
            $validated = $request->validate([
                'user_location_id' => ["required"]
            ]);
            $application = App::create([
                'user_id' => Auth::id(),
                'delivery_type' => $request['delivery_type'],
                'city_id' => 1,
                'user_location_id' => $request['user_location_id'],
                'payment_type' => $request['payment_type'],
                'pre_pay' => $request['pre_pay'],
                'message' => $request->get('message'),
                "app_status" => "published",
                'delivery_date' => $request['delivery_date'],
                'postponement' => $request['postponement']
            ]);
            foreach ($getCart as $cart){
                if ($cart->user_id == Auth::id()) {
                    if ($cart->aids_id == null){
                        return redirect()->back()->with('errorNull', 'Корзина пустая');
                    }

                    else{
                        if ( $cart->user_culture_square <= 0){
                            return redirect()->back()->with('errorSquare', 'Площадь должен быть больше 0');
                        }
                        elseif ($cart->user_culture_util_norm <= 0){
                            return redirect()->back()->with('errorUtilNorm', 'Норма рассхода должен быть больше 0');
                        }
                        else{
                            $validated = $request->validate([
                                "user_culture_util_norm" => ["numeric"],
                                "user_culture_square" => ["numeric"]
                            ]);
                            $cart = Applications::create([
                                'application_id' => $application['application_id'],
                                'aids_id' => $cart->aids_id,
                                'culture_name' => $cart->user_culture,
                                "user_culture_util_norm" => $cart->user_culture_util_norm,
                                "user_culture_square" => $cart->user_culture_square,
                            ]);
                        }
                        \Illuminate\Support\Facades\DB::table('carts')
                            ->where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->user_id)
                            ->delete();
                    }
                }
            }
        }



        return redirect()->back()->with('successAddApp', 'Успешно добвалено в заявки');
    }


    public function applicationUpdateUtilNorm(Request $request, $app_id){
        $updateUtilNorm = Applications::find($app_id);

        $validated = $request->validate([
            "user_culture_util_norm" => ["numeric"],
        ]);

        if ($request['user_culture_util_norm'] <= 0){
            return redirect()->back()->with('errorUtilNormApp', 'Норма рассхода должен быть больше 0');
        }

        $updateUtilNorm->user_culture_util_norm = $request['user_culture_util_norm'];
        $updateUtilNorm->save();

        return redirect()->back()->with('updateMess','Успешно сохранено');
    }

    public function applicationUpdateSquare(Request $request, $app_id){
        $updateSquare = Applications::find($app_id);
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

    public function delFromApp($app_id){
        Applications::find($app_id)->delete();
        return redirect()->back()->with('successDelFromApp', 'Успешно удалено c заявки');
    }


    public function applicationPublish($application_id){
        $applicationPublish = App::find($application_id);
        if ($applicationPublish){
            $applicationPublish->app_status = 'published';
            $applicationPublish->save();
            return redirect()->back()->with('updatePublished','Ваша заявка успешно обубликовано!');
        }else{
            return redirect()->back();
        }
    }

    public function delApplication($application_id){
        App::find($application_id)->delete();
        return redirect()->back()->with('successDelFromApp', 'Успешно удалено c заявки');
    }

    public function publishToNew($application_id){
        $applicationPublish = App::find($application_id);

        if ($applicationPublish){
            $applicationPublish->app_status = 'new';
            $applicationPublish->save();
            return redirect()->back()->with('updateNew','Ваша заявка успешно отозвано!');
        }else{
            return redirect()->back();
        }
    }

    public function editDelivery($application_id, Request $request){
        $editDelivery = App::find($application_id);

        if ($editDelivery){

            if ($request['delivery_type'] == 'selfCall'){
                $editDelivery->delivery_type = 'selfCall';
                $editDelivery->save();
                $editDelivery->city_id = $request['city_id'];
                $editDelivery->save();
                return redirect()->back()->with('updateMess','Успешно сохранено');
            }
            else if ($request['delivery_type'] == 'delivery'){
                $editDelivery->delivery_type = 'delivery';
                $editDelivery->save();
                $editDelivery->user_location_id = $request['user_location_id'];
                $editDelivery->save();
                return redirect()->back()->with('updateMess','Успешно сохранено');
            }
        }
        return redirect()->back();
    }


    public function editPayment($application_id, Request $request){
        $editDelivery = App::find($application_id);

        if ($editDelivery){

            if ($request['payment_type'] == 'payfull'){
                $editDelivery->payment_type = 'payfull';
                $editDelivery->save();
                return redirect()->back()->with('updateMess','Успешно сохранено');
            }
            else if ($request['payment_type'] == 'pre_pay'){
                $editDelivery->payment_type = 'pre_pay';
                $editDelivery->save();
                $editDelivery->pre_pay = $request['pre_pay'];
                $editDelivery->save();
                return redirect()->back()->with('updateMess','Успешно сохранено');
            }
        }
        return redirect()->back();
    }

    public function check(){
        return view('farmer_app');
    }

}

<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Aids;
use App\Models\Countries;
use App\Models\Cultures;
use App\Models\Localities;
use App\Models\Locations;
use App\Models\Regions;
use App\Models\Subregions;
use App\Models\User;
use App\Models\User_cultures;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view("auth.login");
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validate([
            "phoneNumber" => ["required"],
            "password" => ["required", "min:6"]
        ]);

        if(auth("web")->attempt($data)) {
            return redirect(("/"));
        }

        return redirect(route("login"))->withErrors(["phoneNumber" => "Пользователь не найден, либо данные введены не правильно"]);
    }

    public function logout()
    {
        auth("web")->logout();
        return redirect(route("checkPhoneNumberExist"));
    }

    public function showRegisterForm()
    {
        return view("auth.register");
    }

    public function showForgotForm()
    {
        return view("auth.forgot");
    }

    public function register(RegisterRequest $request)
    {
        $user = User::query()->create([
            "name" => $request->name,
            "phoneNumber" =>  $request->phoneNumber,
            "role" => $request->role,
            "password" => bcrypt($request->password)
        ]);

        if($user) {
            //event(new Registered($user));
            auth("web")->login($user);
        }

        return redirect('/');
    }

    public function showProfile(Request $request)
    {

        $locations = Locations::query();

        $location = $locations
            ->leftJoin('users', function ($join) {
                $join->on('locations.user_id', '=', 'users.user_id');

            })->leftJoin('countries', function ($join) {
                $join->on('locations.country_id', '=', 'countries.id');

            })->leftJoin('localities', function ($join) {
                $join->on('locations.locality_id', '=', 'localities.id')

                    ->join('subregions', function ($join) {
                        $join->on('localities.subregion_id', '=', 'subregions.id')

                            ->join('regions', function ($join) {
                                $join->on('subregions.region_id', '=', 'regions.id');
                            });
                    });
            })
            ->paginate();

        $userCultures = User_cultures::query();

        $userCulture = $userCultures
            ->leftJoin('users', function ($join) {
                $join->on('user_cultures.user_id', '=', 'users.user_id');
            })
            ->leftJoin('cultures', function ($join) {
                $join->on('user_cultures.culture_id', '=', 'cultures.culture_id');
            })
            ->paginate();


        $user = Auth::user();
        $countries = Countries::all();
        $regions = Regions::all();
        $subregions = Subregions::all();
        $localities = Localities::all();
        $cultures = Cultures::all();

        return view("profile", compact('user', 'location', 'countries','regions', 'subregions',
            'localities', 'cultures', 'userCulture'));
    }

    public function editProfile(Request $request){
        $user = User::find(Auth::user()->user_id);

        if ($user){
            $user->name = $request['name'];
            $user->email = $request['email'];

            $user->save();

            return redirect()->back()->with('message','Успешно сохранено');
        }else{
            return redirect()->back();
        }

    }

    public function editLocation(Request $request){

        $location = $request->validate([
            "country_id" => ["required"],
            "region_id" => ["required"],
            "subregion_id" => ["required"],
            "address" => ["required"],
            "locality_id" => ["required"]
        ]);

        $location = Locations::create([
            'user_id' => Auth::user()->user_id,
            'country_id' => $request['country_id'],
            'region_id' => $request['region_id'],
            'subregion_id' => $request['subregion_id'],
            'city_id' => $request['city_id'],
            'locality_id' => $request['locality_id'],
            'address' => $request['address'],
            'comment' => $request['comment'],
        ]);

        return redirect()->back()->with('successLocation', 'Успешно сохранено');

    }

    public function locDel($loc_id){
        $status = Locations::find($loc_id);
        $status->status = false;
        $status->update();

        return redirect()->back();
    }

    public function editCulture(Request $request){

        $userCultures = $request->validate([
            "culture_id" => ["required"],
            "square" => ["required"],
            "yearSowing" => ["required"]
        ]);

        $userCultures = User_cultures::create([
            'user_id' => Auth::user()->user_id,
            'culture_id' => $request['culture_id'],
            'square' => $request['square'],
            'yearSowing' => $request['yearSowing'],
        ]);

        return redirect()->back()->with('successCulture', 'Успешно сохранено');

    }

    public function cultDel($id){
        $status = User_cultures::find($id);
        $status->status = false;
        $status->update();
        return redirect()->back();
    }


    public function showCheckPhoneNumberExist(){
        return view('auth.checkPhoneNumberExist');
    }


    public function checkPhoneNumberExist(Request $request)
    {

        if (isset($_GET['phoneNumber'])) {
            session_start();
            $_SESSION['phoneNumber'] = $_GET['phoneNumber'];
        }

        $data = $request->validate([
            "phoneNumber" => ["required"],
        ]);

        if (DB::table('Users')->where('phoneNumber', $data)->exists()) {
            return redirect('/login');
        } else {
            return redirect('/register');
        }

    }

}

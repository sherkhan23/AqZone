<?php

namespace App\Http\Controllers;

use App\Exports\AidsExport;
use App\Exports\CategoryExport;
use App\Models\Admin;
use App\Models\AidComponents;
use App\Models\Aids;
use App\Models\AidsUtilizationNorms;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\Countries;
use App\Models\Cultures;
use App\Models\Dosage;
use App\Models\HazardObjects;
use App\Models\PreparativeForms;
use App\Models\Producers;
use App\Models\UnitOfMeasures;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{



    public function admin(){
        Paginator::useBootstrap();

        $users = User::query()
            ->orderBy('user_id', 'asc')
            ->paginate(7);

        return view('admin.adminPage', compact('users'));
    }

    public function farmer(){
        Paginator::useBootstrap();
        $users = User::query()
            ->where('role', '=', 'farmer')
            ->orderBy('user_id', 'asc')
            ->paginate(7);

        return view('admin.adminPage', compact('users'));
    }

    public function seller(){
        Paginator::useBootstrap();
        $users = User::query()
            ->where('role', '=', 'seller')
            ->orderBy('user_id', 'asc')
            ->paginate(7);

        return view('admin.adminPage', compact('users'));
    }

    public function forAids(){
        Paginator::useBootstrap();
        $aids = Aids::query()
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

            ->orderBy('aids_id', 'asc')
            ->paginate(6);

        $categories = Categories::all();
        $preparativeForms = PreparativeForms::all();
        $components = AidComponents::all();
        $utilNorms = AidsUtilizationNorms::all();
        $producers = Producers::all();
        $brands = Brands::all();
        $unitOfMeasures = UnitOfMeasures::all();


        return view('admin.aidsAdmin', compact('aids', 'categories', 'preparativeForms',
            'components', 'utilNorms', 'producers', 'brands', 'unitOfMeasures'));
    }


    public function aids($aids_id){

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


        $categories = Categories::all();
        $preparativeForms = PreparativeForms::all();
        $components = AidComponents::all();
        $utilNorms = AidsUtilizationNorms::all();
        $producers = Producers::all();
        $brands = Brands::all();
        $cultures = Cultures::query()->get();
        $unitOfMeasures = UnitOfMeasures::all();
        $hazards = HazardObjects::all();

        $dosages = DB::table('dosages')
            ->leftJoin('aid_components', function ($join) {
                $join->on('dosages.aid_component_id', '=', 'aid_components.aid_component_id');
            })
            ->leftJoin('unit_of_measures', function ($join) {
                $join->on('dosages.unit_of_measure_id', '=', 'unit_of_measures.unit_of_measure_id');
            })
            ->leftJoin('aids', function ($join) {
                $join->on('dosages.aids_id', '=', 'aids.aids_id');
            })
            ->get();

        $unitOfMeasuresAids = DB::table('aids_utilization_norms')
            ->leftJoin('aids', function ($join) {
                $join->on('aids_utilization_norms.aids_id', '=', 'aids.aids_id');
            })->leftJoin('cultures', function ($join) {
                $join->on('aids_utilization_norms.culture_id', '=', 'cultures.culture_id');
            })->leftJoin('hazard_objects', function ($join) {
                $join->on('aids_utilization_norms.hazard_id', '=', 'hazard_objects.hazard_id');
            })
            ->get();


        return view('admin.aids', compact( 'aidItem', 'categories', 'preparativeForms',
            'components', 'utilNorms', 'producers', 'brands', 'cultures', 'unitOfMeasures', 'dosages',
            'hazards', 'unitOfMeasuresAids'));
    }

    // редактировать  данные юзера
    public function editUser(Request $request, $user_id){
        $user = User::query()->find($user_id);
        $user->name = $request->name;
        $user->phoneNumber = $request->phoneNumber;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->isAdmin = $request->isAdmin;
        $user->save();
        return redirect()->back()->with('updateMess','Успешно сохранено');
    }
    // редактировать данные юзера

    public function delUser($user_id){
        $user = User::find($user_id)->delete();
        return redirect()->back()->with('updateMess','Успешно удалено');
    }

    public function createUser(Request $request){
        $data = $request->validate([
            "name" => ["required", "string"],
            "phoneNumber" => ["required", "string", "unique:users,phoneNumber"],
            "role" => ['required'],
            "password" => ["required", "confirmed"]
        ]);

        $user = User::create([
            "name" => $data["name"],
            "phoneNumber" => $data["phoneNumber"],
            "role" => $data["role"],
            "password" => bcrypt($data["password"])
        ]);

        return redirect()->back()->with('updateMess','Успешно сохранено');
    }

    public function editAids(Request $request, $aids_id){
        $aid = Aids::find($aids_id);
        $aid->aidName = $request->aidName;
        $aid->category_id = $request->category_id;
        $aid->preparative_forms_id = $request->preparative_forms_id;
        $aid->aid_components_id = $request->aid_components_id;
        $aid->aids_utilization_norm_id = $request->aids_utilization_norm_id;
        $aid->packs = $request->packs;
        $aid->producer_id = $request->producer_id;
        $aid->brand_id = $request->brand_id;
        $aid->registrationEndDate = $request->registrationEndDate;

        $aid->save();
        return redirect()->back()->with('updateMess','Успешно сохранено');
    }

    public function delAid($aids_id){
        $aids = Aids::find($aids_id)->delete();
        return redirect()->back()->with('updateMess','Успешно удалено');
    }

    public function createAids(){

        $categories = Categories::all();
        $preparativeForms = PreparativeForms::all();
        $components = AidComponents::all();
        $utilNorms = AidsUtilizationNorms::all();
        $producers = Producers::all();
        $brands = Brands::all();

        return view('admin.createAidsAdmin', compact('categories', 'preparativeForms',
            'components', 'utilNorms', 'producers', 'brands'));
    }

    public function createAid(Request $request){
        $aid = $request->validate([
            "aidName" => ["required", "string"],
            "category_id" => ["required"],
            "preparative_forms_id" => ["required"],
            "aid_components_id" => ["required"],
            "packs" => ["required"],
            "producer_id" => ["required"],
            "brand_id" => ["required"],
            "registrationEndDate" => ["required"],
        ]);
        $aid = Aids::query()->create([
            "aidName" => $aid["aidName"],
            "category_id" => $aid["category_id"],
            "preparative_forms_id" => $aid['preparative_forms_id'],
            "aid_components_id" => $aid['aid_components_id'],
            "packs" => $aid['packs'],
            "producer_id"=> $aid["producer_id"],
            "brand_id" => $aid['brand_id'],
            "registrationEndDate" => $aid['registrationEndDate'],
            "created_at" => date(now())
        ]);



        return redirect()->back()->with('updateMess','Успешно сохранено');
    }


    public function createCategory(Request $request){
        $cat = Categories::query()->create([
            'categoryName' => $request->categoryName,
            'details' => $request->details
        ]);
        return redirect()->back()->with('updateMess','Успешно добавлено');
    }

    public function createPremForm(Request $request){
        $data = PreparativeForms::query()->create([
            'prepFormName' => $request->prepFormName,
            'prepFormShortName' => $request->prepFormShortName
        ]);
        return redirect()->back()->with('updateMess','Успешно добавлено');
    }

    public function createComponent(Request $request){
        $data = AidComponents::query()->create([
            'componentName' => $request->componentName,
            'unit_of_measures_id' => $request->unit_of_measures_id,
            'preparative_forms_id' => $request->preparative_forms_id
        ]);
        return redirect()->back()->with('updateMess','Успешно добавлено');
    }

    public function createUtils(Request $request){
        $data = AidsUtilizationNorms::query()->create([
            'culture_id' => $request->culture_id,
            'hazard_id'  => $request->hazard_id,
            'utilizationRate'  => $request->utilizationRate,
            'maxUtilizationRate'  => $request->maxUtilizationRate,
            'minUtilizationRate'  => $request->minUtilizationRate,
            'utilizationRateComment'  => $request->utilizationRateComment,
            'maxApplicationNorm'  => $request->maxApplicationNorm,
            'applicationRules'  => $request->applicationRules,
            'finalApplicationTerms'  => $request->finalApplicationTerms,
            'mechanicalWorksPostponing'  => $request->mechanicalWorksPostponing,
            'manualWorksPostponing' => $request->manualWorksPostponing
        ]);

        return redirect()->back()->with('updateMess','Успешно добавлено');

    }

    public function createProducer(Request $request){
        $data = Producers::query()->create([
            'ProducerName' => $request->ProducerName,
            'producerCountry' => $request->producerCountry,
            'brand_id' => $request->brand_id
        ]);
        return redirect()->back()->with('updateMess','Успешно добавлено');
    }

    public function createBrand(Request $request){
        $data = Brands::query()->create([
            'BrandName' => $request->BrandName,
        ]);
        return redirect()->back()->with('updateMess','Успешно добавлено');
    }


    public function getPreparativeForm(){
        $preps = PreparativeForms::query()->paginate(5);
        Paginator::useBootstrap();
        return view('admin.preparativeForms', compact('preps'));
    }

    public function editPreparativeForm(Request $request, $id){
        $preps = PreparativeForms::query()->find($id);
        $preps->prepFormName = $request->prepFormName;
        $preps->prepFormShortName = $request->prepFormShortName;
        $preps->save();
        return redirect()->back()->with('updateMess','Успешно добавлено');
    }

    public function delPreparativeForm($id){
        $preps = PreparativeForms::query()->find($id)->delete();
        return redirect()->back()->with('updateMess','Успешно удалено');
    }

    // components
    public function getComponent(){
        $components = AidComponents::query()
            ->leftJoin('unit_of_measures', function ($join) {
                $join->on('aid_components.unit_of_measures_id', '=', 'unit_of_measures.unit_of_measure_id');
            })
            ->leftJoin('preparative_forms', function ($join) {
                $join->on('aid_components.preparative_forms_id', '=', 'preparative_forms.id');
            })
            ->orderBy('aid_component_id', 'asc')
        ->paginate(5);

        Paginator::useBootstrap();
        $preparativeForms = PreparativeForms::query()->get();
        $unitOfMeasures = UnitOfMeasures::query()->get();
        $utilNorms = AidsUtilizationNorms::query()->get();
        return view('admin.component', compact('components', 'preparativeForms'
        , 'unitOfMeasures', 'utilNorms'));
    }
    public function editComponent(Request $request, $aid_component_id){
        $components = AidComponents::query()->find($aid_component_id);

        $components->componentName = $request->componentName;
        $components->unit_of_measures_id = $request->unit_of_measure_id;
        $components->preparative_forms_id = $request->preparative_forms_id;

        $components->save();
        return redirect()->back()->with('updateMess','Успешно добавлено');
    }
    public function delComponent($aid_component_id){
        $components = AidComponents::query()->find($aid_component_id)->delete();
        return redirect()->back()->with('updateMess','Успешно удалено');
    }

//     components

    public function getUtilNorms(){
        $utils = AidsUtilizationNorms::query()
            ->leftJoin('cultures', function ($join) {
                $join->on('aids_utilization_norms.culture_id', '=', 'cultures.id');
            })
            ->leftJoin('hazard_objects', function ($join) {
                $join->on('aids_utilization_norms.hazard_id', '=', 'hazard_objects.hazard_id');
            })
            ->orderBy('util_norm_id', 'asc')
            ->paginate(10);

        $components = AidComponents::query()->paginate();
        $cultures = Cultures::query()->paginate();
        $hazards = HazardObjects::query()->paginate();
        $unitOfMeasures = UnitOfMeasures::query()->paginate();

        return view('admin.utilNorms', compact('utils', 'components',
        'cultures', 'hazards', 'unitOfMeasures'));
    }


    // producers
    public function getProducers(){
        $producers = Producers::query()
            ->leftJoin('brands', function ($join) {
                $join->on('producers.brand_id', '=', 'brands.id');
            })
            ->orderBy('producer_id', 'asc')
        ->paginate(10);

        $countries = Countries::query()->get();
        $brands = Brands::all();
        Paginator::useBootstrap();
        return view('admin.producers', compact('producers', 'brands', 'countries'));
    }

    public function editProducers(Request $request, $producer_id){
        $producerEdit = Producers::query()->find($producer_id);
        $producerEdit->ProducerName = $request->ProducerName;
        $producerEdit->producerCountry = $request->producerCountry;
        $producerEdit->brand_id = $request->brand_id;

        $producerEdit->save();
        return redirect()->back()->with('updateMess','Успешно добавлено');
    }

    public function delProducer($producer_id){
        $delProducer = Producers::query()->find($producer_id)->delete();
        return redirect()->back()->with('updateMess','Успешно удалено');
    }
    // producers

    //brand
    public function getBrands(){
        $brands = Brands::query()
            ->paginate(5);
        Paginator::useBootstrap();
        return view('admin.brands', compact('brands'));
    }

    public function editBrand(Request $request, $id){
        $brand = Brands::query()->find($id);
        $brand->BrandName = $request->BrandName;
        $brand->save();
        return redirect()->back()->with('updateMess','Успешно добавлено');
    }

    public function delBrand($id){
        $brand = Brands::query()->find($id)->delete();
        return redirect()->back()->with('updateMess','Успешно удалено');
    }
    //brand

    public function createDosage(Request $request, $aids_id){
        $dosage = Dosage::query()->create([
            'aids_id' => $request->aids_id,
            'aid_component_id' => $request->aid_components_id,
            'unit_of_measure_id' => $request->unit_of_measure_id,
            'dosage' => $request->dosage
        ]);

        return redirect()->back()->with('updateMess','Успешно добавлено');
    }

    public function delDosage($dosage_id){
        $dosage = Dosage::query()->find($dosage_id)->delete();
        return redirect()->back()->with('updateMess','Успешно удалено');
    }

    public function createCulture(Request $request, $aids_id){
        $culture = Cultures::query()->create([
            'aids_culture_id' => $aids_id,
            'cultureName' => $request->cultureName,
        ]);

        return redirect()->back()->with('updateMess','Успешно добавлено');
    }

    public function exportAids(){
        return Excel::download(new AidsExport(), 'aids.xlsx');
    }
}

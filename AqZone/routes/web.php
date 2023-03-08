<?php

use App\Models\Aids;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\Controller::class, 'mainPage'])->name('home');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function (){
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
    Route::get('/farmer', [\App\Http\Controllers\AdminController::class, 'farmer'])->name('farmer');
    Route::get('/seller', [\App\Http\Controllers\AdminController::class, 'seller'])->name('seller');
    Route::post('/edit-user/{user_id}',  [\App\Http\Controllers\AdminController::class, 'editUser'])->name('editUser');
    Route::post('/del-user/{user_id}',  [\App\Http\Controllers\AdminController::class, 'delUser'])->name('delUser');
    Route::post('/create-user',  [\App\Http\Controllers\AdminController::class, 'createUser'])->name('createUser');

    Route::get('/aids', [\App\Http\Controllers\AdminController::class, 'forAids'])->name('aidsAdmin');
    Route::get('/aids/{aids_id}', [\App\Http\Controllers\AdminController::class, 'aids'])->name('aids');
    Route::post('/edit-aids/{aids_id}',  [\App\Http\Controllers\AdminController::class, 'editAids'])->name('editAids');
    Route::post('/del-aids/{aids_id}',  [\App\Http\Controllers\AdminController::class, 'delAid'])->name('delAid');
    Route::get('/export-aids' , [\App\Http\Controllers\AdminController::class, 'exportAids'])->name('exportAids');


    Route::get('/create-aids', [\App\Http\Controllers\AdminController::class, 'createAids'])->name('createAids');
    Route::post('/create-aid', [\App\Http\Controllers\AdminController::class, 'createAid'])->name('createAid');
    Route::post('/create-category', [\App\Http\Controllers\AdminController::class, 'createCategory'])->name('createCategory');
    Route::post('/create-prep-form', [\App\Http\Controllers\AdminController::class, 'createPremForm'])->name('createPremForm');
    Route::post('/create-component', [\App\Http\Controllers\AdminController::class, 'createComponent'])->name('createComponent');
    Route::post('/create-utils', [\App\Http\Controllers\AdminController::class, 'createUtils'])->name('createUtils');
    Route::post('/create-producer', [\App\Http\Controllers\AdminController::class, 'createProducer'])->name('createProducer');
    Route::post('/create-brand', [\App\Http\Controllers\AdminController::class, 'createBrand'])->name('createBrand');


    // categories
    Route::get('/categories', [\App\Http\Controllers\CategoriesController::class, 'getCategories'])->name('getCategories');
    Route::post('/edit-categories/{id}', [\App\Http\Controllers\CategoriesController::class, 'editCategories'])->name('editCategories');
    Route::post('/del-categories/{id}', [\App\Http\Controllers\CategoriesController::class, 'delCategory'])->name('delCategory');
    Route::post('/import-categories' , [\App\Http\Controllers\CategoriesController::class, 'importCategory'])->name('importCategory');
    Route::get('/export-categories' , [\App\Http\Controllers\CategoriesController::class, 'exportCategory'])->name('exportCategory');

    Route::get('/preparative-form', [\App\Http\Controllers\AdminController::class, 'getPreparativeForm'])->name('getPreparativeForm');
    Route::post('/edit-preparative-form/{id}', [\App\Http\Controllers\AdminController::class, 'editPreparativeForm'])->name('editPreparativeForm');
    Route::post('/del-preparative-form/{id}', [\App\Http\Controllers\AdminController::class, 'delPreparativeForm'])->name('delPreparativeForm');

    Route::get('/component-form', [\App\Http\Controllers\AdminController::class, 'getComponent'])->name('getComponent');
    Route::post('/edit-component/{aid_component_id}', [\App\Http\Controllers\AdminController::class, 'editComponent'])->name('editComponent');
    Route::post('/del-component/{aid_component_id}', [\App\Http\Controllers\AdminController::class, 'delComponent'])->name('delComponent');

//    Route::get('/util-norms', [\App\Http\Controllers\AdminController::class, 'getUtilNorms'])->name('getUtilNorms');

    Route::get('/producers', [\App\Http\Controllers\AdminController::class, 'getProducers'])->name('getProducers');
    Route::post('/editProducers/{producer_id}', [\App\Http\Controllers\AdminController::class, 'editProducers'])->name('editProducers');
    Route::post('/delProducer/{producer_id}', [\App\Http\Controllers\AdminController::class, 'delProducer'])->name('delProducer');

    Route::get('/brands', [\App\Http\Controllers\AdminController::class, 'getBrands'])->name('getBrands');
    Route::post('/editBrand/{id}', [\App\Http\Controllers\AdminController::class, 'editBrand'])->name('editBrand');
    Route::post('/delBrand/{id}', [\App\Http\Controllers\AdminController::class, 'delBrand'])->name('delBrand');

    Route::post('/create-dosage/{aids_id}', [\App\Http\Controllers\AdminController::class, 'createDosage'])->name('createDosage');
    Route::post('/del-dosage/{dosage_id}', [\App\Http\Controllers\AdminController::class, 'delDosage'])->name('delDosage');

    Route::post('/create-util-norm/{aids_id}', [\App\Http\Controllers\AidsUtilizationNormsController::class, 'createUtilNorm'])->name('createUtilNorm');
    // cultures
    Route::get('/cultures', [\App\Http\Controllers\CulturesController::class, 'index'])->name('cultures');
    Route::post('/create-culture', [\App\Http\Controllers\CulturesController::class, 'create'])->name('createCulture');
    Route::post('/edit-culture/{culture_id}', [\App\Http\Controllers\CulturesController::class, 'edit'])->name('editCultureAdmin');
    Route::post('/del-culture/{culture_id}', [\App\Http\Controllers\CulturesController::class, 'destroy'])->name('delCulture');


    //hazards
    Route::get('/hazards', [\App\Http\Controllers\HazardObjectsController::class, 'index'])->name('hazards');
    Route::post('/create-hazards', [\App\Http\Controllers\HazardObjectsController::class, 'create'])->name('createHazards');
    Route::post('/edit-hazards/{hazard_id}', [\App\Http\Controllers\HazardObjectsController::class, 'edit'])->name('editHazards');
    Route::post('/del-hazards/{hazard_id}', [\App\Http\Controllers\HazardObjectsController::class, 'destroy'])->name('delHazard');

    //
    Route::get('/unit-of-measure', [\App\Http\Controllers\UnitOfMeasuresController::class, 'index'])->name('unitOfMeasure');
    Route::post('/create-unit-of-measure', [\App\Http\Controllers\UnitOfMeasuresController::class, 'create'])->name('createUnitOfMeasure');
    Route::post('/del-unit-of-measure/{unit_of_measure_id}', [\App\Http\Controllers\UnitOfMeasuresController::class, 'destroy'])->name('destroyUnitOfMeasure');

    // countries
    Route::get('/countries', [\App\Http\Controllers\CountriesController::class, 'index'])->name('countries');
    Route::post('/create-country', [\App\Http\Controllers\CountriesController::class, 'create'])->name('createCountry');

});

Route::middleware("guest:web")->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login_process', [\App\Http\Controllers\AuthController::class, 'login'])->name('login_process');

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [\App\Http\Controllers\AuthController::class, 'register'])->name('register_process');

    Route::get('/check-phone-number-exist', [\App\Http\Controllers\AuthController::class, 'showCheckPhoneNumberExist'])->name('showCheckPhoneNumberExist');
    Route::post('/check-phone-number-exist', [\App\Http\Controllers\AuthController::class, 'checkPhoneNumberExist'])->name('checkPhoneNumberExist');
});

Route::any('send-sms', [\App\Http\Controllers\SMSController::class, 'send'])->name('send_sms');
Route::any('sms-process', [\App\Http\Controllers\SMSController::class, 'sms_process'])->name('sms_process');
Route::any('sms-process_check', [\App\Http\Controllers\SMSController::class, 'sms_process_check'])->name('sms_process_check');


//Route::middleware("auth:farmer")->group(function (){
//    Route::get('/farmer', )
//});
Route::middleware("auth:web")->group(function () {
    #profile
    Route::get('/profile',[\App\Http\Controllers\AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [\App\Http\Controllers\AuthController::class, 'editProfile'])->name('editProfile');
    Route::post('/edit-location', [\App\Http\Controllers\AuthController::class, 'editLocation'])->name('editLocation');
    Route::post('/edit-culture', [\App\Http\Controllers\AuthController::class, 'editCulture'])->name('editCulture');

    # cart
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'cart'])->name('cart');
    Route::post('/update-cart/{aids_id}', [\App\Http\Controllers\CartController::class, 'update_cart'])->name('update_cart');
    Route::delete('/delete-cart/{cart_id}',[\App\Http\Controllers\CartController::class, 'delCart'] )->name('delCart');
    Route::post('/update-util-norm/{cart_id}', [\App\Http\Controllers\CartController::class, 'updateUtilNorm'])->name('updateUtilNorm');
    Route::post('/update-square/{cart_id}/', [\App\Http\Controllers\CartController::class, 'updateSquare'])->name('updateSquare');
    # end cart

    #application updates
    Route::post('/application-update-util-norm/{app_id}', [\App\Http\Controllers\ApplicationsController::class, 'applicationUpdateUtilNorm'])->name('applicationUpdateUtilNorm');
    Route::post('/application-update-square/{app_id}/', [\App\Http\Controllers\ApplicationsController::class, 'applicationUpdateSquare'])->name('applicationUpdateSquare');
    Route::post('/del-from-app/{app_id}/', [\App\Http\Controllers\ApplicationsController::class, 'delFromApp'])->name('delFromApp');
    Route::post('/application-publish/{application_id}/', [\App\Http\Controllers\ApplicationsController::class, 'applicationPublish'])->name('applicationPublish');
    Route::post('/del-application/{application_id}/', [\App\Http\Controllers\ApplicationsController::class, 'delApplication'])->name('delApplication');
    Route::post('/publish-to-new/{application_id}/', [\App\Http\Controllers\ApplicationsController::class, 'publishToNew'])->name('publishToNew');
    Route::post('/edit-delivery/{application_id}/', [\App\Http\Controllers\ApplicationsController::class, 'editDelivery'])->name('editDelivery');
    Route::post('/edit-payment/{application_id}/', [\App\Http\Controllers\ApplicationsController::class, 'editPayment'])->name('editPayment');
    # end application updates

    # applications
    Route::get('/applications',[\App\Http\Controllers\ApplicationsController::class, 'applications'])->name('applications');
    Route::post('/add-applications',[\App\Http\Controllers\ApplicationsController::class, 'addApplication'])->name('addApplication');
    # end applications

    #create Offer
    Route::post('/create-offer/{application_id}/', [\App\Http\Controllers\OffersController::class, 'createOffer'])->name('createOffer');
    #end create offer

    # create accept offer
    Route::post('/receive-offer/{offer_id}/', [\App\Http\Controllers\OffersController::class, 'receiveOffer'])->name('receiveOffer');
    # end offer accept

    # application accept
    Route::post('accept-application/{application_id}', [\App\Http\Controllers\OffersController::class, 'acceptApplication'])->name('acceptApplication');
    # application accept

    # accept Offer To Draft
    Route::post('accept-offer-to-draft/{offer_id}', [\App\Http\Controllers\OffersController::class, 'acceptOfferToDraft'])->name('acceptOfferToDraft');
    # accept Offer To Draft

    # profile user culture and location
    Route::delete('/delete-location/{loc_id}',[\App\Http\Controllers\AuthController::class, 'locDel'])->name('locDel');
    Route::delete('/delete-culture/{cult_id}',[\App\Http\Controllers\AuthController::class, 'cultDel'])->name('cultDel');
    # profile user culture and location


    # for check something
    Route::any('/check', [\App\Http\Controllers\ApplicationsController::class, 'check'])->name('check');
    # for check something

    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    // Route::post('/posts/comment/{id}', [\App\Http\Controllers\PostController::class, 'comment'])->name('comment');
});

Route::any('/catalog', '\App\Http\Controllers\AidsController@Aids')->name('catalog');
Route::get('/{aids_id}', [\App\Http\Controllers\AidsController::class, 'getAids'])->name('show_aids');

//Route::get('producer', [\App\Http\Controllers\ProducersController::class, 'index'])->name('producer.index');
//Route::get('/applications', [\App\Http\Controllers\AuthController::class, 'showApplications'])->name('applications');
//Route::post('/checkPhoneNumberExist', [\App\Http\Controllers\AuthController::class, 'checkPhoneNumberExist'])->name('checkPhoneNumberExist');



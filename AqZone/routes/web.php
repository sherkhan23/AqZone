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
    Route::get('/aids', [\App\Http\Controllers\AdminController::class, 'forAids'])->name('aids');
});

Route::middleware("guest:web")->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login_process', [\App\Http\Controllers\AuthController::class, 'login'])->name('login_process');

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [\App\Http\Controllers\AuthController::class, 'register'])->name('register_process');

    Route::get('/checkPhoneNumberExist', [\App\Http\Controllers\AuthController::class, 'showCheckPhoneNumberExist'])->name('showCheckPhoneNumberExist');
    Route::post('/checkPhoneNumberExist', [\App\Http\Controllers\AuthController::class, 'checkPhoneNumberExist'])->name('checkPhoneNumberExist');

});

Route::any('send_sms', [\App\Http\Controllers\SMSController::class, 'send'])->name('send_sms');
Route::any('sms_process', [\App\Http\Controllers\SMSController::class, 'sms_process'])->name('sms_process');
Route::any('sms_process_check', [\App\Http\Controllers\SMSController::class, 'sms_process_check'])->name('sms_process_check');


//Route::middleware("auth:farmer")->group(function (){
//    Route::get('/farmer', )
//});
Route::middleware("auth:web")->group(function () {
    #profile
    Route::get('/profile',[\App\Http\Controllers\AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [\App\Http\Controllers\AuthController::class, 'editProfile'])->name('editProfile');
    Route::post('/editLocation', [\App\Http\Controllers\AuthController::class, 'editLocation'])->name('editLocation');
    Route::post('/editCulture', [\App\Http\Controllers\AuthController::class, 'editCulture'])->name('editCulture');

    # cart
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'cart'])->name('cart');
    Route::post('/update_cart/{aids_id}', [\App\Http\Controllers\CartController::class, 'update_cart'])->name('update_cart');
    Route::delete('/delete-cart/{cart_id}',[\App\Http\Controllers\CartController::class, 'delCart'] )->name('delCart');
    Route::post('/updateUtilNorm/{cart_id}', [\App\Http\Controllers\CartController::class, 'updateUtilNorm'])->name('updateUtilNorm');
    Route::post('/updateSquare/{cart_id}/', [\App\Http\Controllers\CartController::class, 'updateSquare'])->name('updateSquare');
    # end cart

    #application updates
    Route::post('/applicationUpdateUtilNorm/{app_id}', [\App\Http\Controllers\ApplicationsController::class, 'applicationUpdateUtilNorm'])->name('applicationUpdateUtilNorm');
    Route::post('/applicationUpdateSquare/{app_id}/', [\App\Http\Controllers\ApplicationsController::class, 'applicationUpdateSquare'])->name('applicationUpdateSquare');
    Route::post('/delFromApp/{app_id}/', [\App\Http\Controllers\ApplicationsController::class, 'delFromApp'])->name('delFromApp');
    Route::post('/applicationPublish/{application_id}/', [\App\Http\Controllers\ApplicationsController::class, 'applicationPublish'])->name('applicationPublish');
    Route::post('/delApplication/{application_id}/', [\App\Http\Controllers\ApplicationsController::class, 'delApplication'])->name('delApplication');
    Route::post('/publishToNew/{application_id}/', [\App\Http\Controllers\ApplicationsController::class, 'publishToNew'])->name('publishToNew');
    Route::post('/editDelivery/{application_id}/', [\App\Http\Controllers\ApplicationsController::class, 'editDelivery'])->name('editDelivery');
    Route::post('/editPayment/{application_id}/', [\App\Http\Controllers\ApplicationsController::class, 'editPayment'])->name('editPayment');
    # end application updates

    # applications
    Route::get('/applications',[\App\Http\Controllers\ApplicationsController::class, 'applications'])->name('applications');
    Route::post('/addApplications',[\App\Http\Controllers\ApplicationsController::class, 'addApplication'])->name('addApplication');
    # end applications

    #create Offer
    Route::post('/createOffer/{application_id}/', [\App\Http\Controllers\OffersController::class, 'createOffer'])->name('createOffer');
    #end create offer

    # create accept offer
    Route::post('/receiveOffer/{offer_id}/', [\App\Http\Controllers\OffersController::class, 'receiveOffer'])->name('receiveOffer');
    # end offer accept

    # application accept
    Route::post('acceptApplication/{application_id}', [\App\Http\Controllers\OffersController::class, 'acceptApplication'])->name('acceptApplication');
    # application accept

    # accept Offer To Draft
    Route::post('acceptOfferToDraft/{offer_id}', [\App\Http\Controllers\OffersController::class, 'acceptOfferToDraft'])->name('acceptOfferToDraft');
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



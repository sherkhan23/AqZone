<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Applications;
use App\Models\OfferData;
use App\Models\Offers;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function createOffer($application_id, Request $request)
    {
        $applications = Applications::query()->get();
        $getApplications = $applications;

        $offer = Offers::create([
            'created_at' => now(),
            'user_offer_id' =>  Auth::id(),
            'publication_id' => $application_id,
            'offer_status' => 'consideration',
            'allSumNDS' => null
        ]);

        foreach ($getApplications as $getApplication) {
            if ($getApplication->application_id == $application_id) {

                $minSumNDS = OfferData::query()->join('offers', function ($join) {$join->on('offer_data.offer_collect', '=', 'offers.offer_id');})
                    ->where('publication_id', '=', $application_id)
                    ->where('aids_id', '=', $getApplication->aids_id)
                    ->get()->min('sumNDS');

                if ($minSumNDS > $request['sumNDS'][$getApplication->app_id]){
                    $offerData = OfferData::create([
                        'offer_collect' => $offer['offer_id'],
                        'aids_id' => $getApplication->aids_id,
                        'cultureNameOffer' => $getApplication->culture_name,
                        'user_culture_square' => $getApplication->user_culture_square,
                        'user_culture_util_norm' => $getApplication->user_culture_util_norm,
                        'requiredQuantity' => $getApplication->user_culture_util_norm * $getApplication->user_culture_square,
                        'offerQuantity' => $request['offerQuantity'][$getApplication->app_id],
                        'offerSumNDS' => $request['offerSumNDS'][$getApplication->app_id],
                        'sumNDS' => $request['sumNDS'][$getApplication->app_id],
                        'minOfferPrice' => 1
                    ]);

                    $editMinNDS = DB::table('offer_data')->where('sumNDS','=', $minSumNDS)->get();
                    foreach ($editMinNDS as $editMinNds){
                        $editMinN = $editMinNds->offer_data_id;
                        $editMinNDSDel = OfferData::find($editMinN);
                        $editMinNDSDel->minOfferPrice = 0;
                        $editMinNDSDel->save();
                    }
                }
                elseif ($minSumNDS === null){
                    $offerData = OfferData::create([
                        'offer_collect' => $offer['offer_id'],
                        'aids_id' => $getApplication->aids_id,
                        'cultureNameOffer' => $getApplication->culture_name,
                        'user_culture_square' => $getApplication->user_culture_square,
                        'user_culture_util_norm' => $getApplication->user_culture_util_norm,
                        'requiredQuantity' => $getApplication->user_culture_util_norm * $getApplication->user_culture_square,
                        'offerQuantity' => $request['offerQuantity'][$getApplication->app_id],
                        'offerSumNDS' => $request['offerSumNDS'][$getApplication->app_id],
                        'sumNDS' => $request['sumNDS'][$getApplication->app_id],
                        'minOfferPrice' => 1
                    ]);
                }
                else{
                    $offerData = OfferData::create([
                        'offer_collect' => $offer['offer_id'],
                        'aids_id' => $getApplication->aids_id,
                        'cultureNameOffer' => $getApplication->culture_name,
                        'user_culture_square' => $getApplication->user_culture_square,
                        'user_culture_util_norm' => $getApplication->user_culture_util_norm,
                        'requiredQuantity' => $getApplication->user_culture_util_norm * $getApplication->user_culture_square,
                        'offerQuantity' => $request['offerQuantity'][$getApplication->app_id],
                        'offerSumNDS' => $request['offerSumNDS'][$getApplication->app_id],
                        'sumNDS' => $request['sumNDS'][$getApplication->app_id],
                        'minOfferPrice' => 0
                    ]);
                }


            }


        }
        return redirect()->back()->with('success', 'Предложения успешно сохранено',);
    }

    public function receiveOffer(Request $request, $offer_id){
        switch ($request->input('action')) {
            case 'saveBestPrices':
                $saveAllOffer = Offers::find($offer_id);
                $saveAllOfferData = DB::table('offer_data')->join('offers', function ($join) {$join->on('offer_data.offer_collect', '=', 'offers.offer_id');})
                    ->where('offer_collect', '=', $offer_id)->get();

                foreach ($saveAllOfferData as $saveAllOfferD){
                    if ($saveAllOfferD->minOfferPrice == 0){
                        $offer_data_id = $saveAllOfferD->offer_data_id;
                        OfferData::find($offer_data_id)->delete();
                    }
                }
                $saveAllOffer->offer_status = 'draft';
                $saveAllOffer->save();

                $saveAllApp = App::find($saveAllOffer->publication_id);
                $saveAllApp->app_status = 'draft';
                $saveAllApp->save();

                return redirect()->back()->with('updateMess','Успешно сохранено');

                break;
            case 'saveAll':
                $saveAllOffer = Offers::find($offer_id);
                $saveAllOffer->offer_status = 'draft';
                $saveAllOffer->save();

                $saveAllApp = App::find($saveAllOffer->publication_id);
                $saveAllApp->app_status = 'draft';
                $saveAllApp->save();

                return redirect()->back()->with('updateMess','Успешно сохранено');
                break;
        }
    }


    public function acceptOffer($application_id){
        $applicationAccept = App::find($application_id);
        $applicationAccept->app_status = 'accept';
        $applicationAccept->save();

//        $offerAccept = Offers::find($offer_id);
//        $offerAccept->offer_status = 'accept';
//        $offerAccept->save();

        return redirect()->back()->with('updateMess','Успешно сохранено');
    }


    public function index()
    {

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
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function show(Offers $offers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function edit(Offers $offers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offers $offers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offers $offers)
    {
        //
    }
}

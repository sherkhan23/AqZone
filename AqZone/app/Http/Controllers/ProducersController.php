<?php

namespace App\Http\Controllers;

use App\Models\Aids;
use App\Models\Producers;
use Illuminate\Http\Request;

class ProducersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producer = Producers::whereHas('brand', function ($query){
            $query->whereId(\request()->input('brand_id'), 0);
        })->pluck('producer_name', 'id');

        return response()->json($producer);

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
     * @param  \App\Models\Producers  $producers
     * @return \Illuminate\Http\Response
     */
    public function show(Producers $producers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producers  $producers
     * @return \Illuminate\Http\Response
     */
    public function edit(Producers $producers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producers  $producers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producers $producers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producers  $producers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producers $producers)
    {
        //
    }
}

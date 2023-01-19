<?php

namespace App\Http\Controllers;

use App\Models\AidComponents;
use Illuminate\Http\Request;

class AidComponentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aidComponents = AidComponents::query();
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
     * @param  \App\Models\AidComponents  $aidComponents
     * @return \Illuminate\Http\Response
     */
    public function show(AidComponents $aidComponents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AidComponents  $aidComponents
     * @return \Illuminate\Http\Response
     */
    public function edit(AidComponents $aidComponents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AidComponents  $aidComponents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AidComponents $aidComponents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AidComponents  $aidComponents
     * @return \Illuminate\Http\Response
     */
    public function destroy(AidComponents $aidComponents)
    {
        //
    }
}

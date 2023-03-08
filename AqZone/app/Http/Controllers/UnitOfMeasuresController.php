<?php

namespace App\Http\Controllers;

use App\Models\UnitOfMeasures;
use Illuminate\Http\Request;

class UnitOfMeasuresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $unit_of_measures = UnitOfMeasures::query()->paginate(10);

        return view('admin.unitOfMeasure', compact('unit_of_measures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        UnitOfMeasures::query()->create([
            'unitOfMeasureName' => $request['unitOfMeasureName'],
            'unitOfMeasureLinkingMultiplicator' => $request['unitOfMeasureLinkingMultiplicator']
        ]);

        return redirect()->back()->with('updateMess','Успешно добавлено');

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
     * @param  \App\Models\UnitOfMeasures  $unitOfMeasures
     * @return \Illuminate\Http\Response
     */
    public function show(UnitOfMeasures $unitOfMeasures)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnitOfMeasures  $unitOfMeasures
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitOfMeasures $unitOfMeasures)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnitOfMeasures  $unitOfMeasures
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitOfMeasures $unitOfMeasures)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitOfMeasures  $unitOfMeasures
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($unit_of_measure_id)
    {
        $unit_of_measures = UnitOfMeasures::query()->find($unit_of_measure_id)->delete();
        return redirect()->back()->with('updateMess','Успешно удалено');

    }
}

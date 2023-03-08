<?php

namespace App\Http\Controllers;

use App\Models\AidsUtilizationNorms;
use Illuminate\Http\Request;

class AidsUtilizationNormsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $aidsUtilizationNorms = AidsUtilizationNorms::query();
        $aidsUtilNorms = $aidsUtilizationNorms
            ->join('aids', function ($join) {
                $join->on('aids_utilization_norms.aids_id', '=', 'aids.aids_id');
            })->join('cultures', function ($join) {
                $join->on('aids_utilization_norms.culture_id', '=', 'cultures.id');
            })->paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUtilNorm(Request $request,$aids_id)
    {
        $utilNorm = AidsUtilizationNorms::query()->create([
            'culture_id' => $request['culture_id'],
            'aids_id' => $aids_id,
            'register_date' => $request['register_date'],
            'minUtilizationRate' => $request['util_norm_min'],
            'maxUtilizationRate' => $request['util_norm_max'],
            'utilizationRate' => ($request['util_norm_min']+$request['util_norm_max'])/2,
            'utilizationRateComment' => 0,
            'finalApplicationTerms' => $request['last_term'],
            'min_multiplicity' => $request['min_multiplicity'],
            'max_multiplicity' => $request['max_multiplicity'],
            'hazard_id' => $request['hazard_id']
        ]);

        return redirect()->back()->with('updateMess','Успешно сохранено');

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
     * @param  \App\Models\AidsUtilizationNorms  $aidsUtilizationNorms
     * @return \Illuminate\Http\Response
     */
    public function show(AidsUtilizationNorms $aidsUtilizationNorms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AidsUtilizationNorms  $aidsUtilizationNorms
     * @return \Illuminate\Http\Response
     */
    public function edit(AidsUtilizationNorms $aidsUtilizationNorms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AidsUtilizationNorms  $aidsUtilizationNorms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AidsUtilizationNorms $aidsUtilizationNorms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AidsUtilizationNorms  $aidsUtilizationNorms
     * @return \Illuminate\Http\Response
     */
    public function destroy(AidsUtilizationNorms $aidsUtilizationNorms)
    {
        //
    }
}

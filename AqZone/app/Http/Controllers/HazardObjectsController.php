<?php

namespace App\Http\Controllers;

use App\Models\Cultures;
use App\Models\HazardObjects;
use Illuminate\Http\Request;

class HazardObjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $hazards = HazardObjects::query()
            ->orderBy('hazard_id', 'asc')
            ->paginate();

        $cultures = Cultures::query()->get();

        return view('admin.hazards', compact('hazards', 'cultures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $data = HazardObjects::query()->create([
            'hazardName' => $request->get('hazardName'),
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
     * @param  \App\Models\HazardObjects  $hazardObjects
     * @return \Illuminate\Http\Response
     */
    public function show(HazardObjects $hazardObjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HazardObjects  $hazardObjects
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($hazard_id, Request $request)
    {
        $hazard = HazardObjects::query()->find($hazard_id);

        $hazard->hazardName = $request['hazardName'];
        $hazard->save();

        return redirect()->back()->with('updateMess','Успешно добавлено');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HazardObjects  $hazardObjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HazardObjects $hazardObjects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HazardObjects  $hazardObjects
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($hazard_id)
    {
        $hazard = HazardObjects::query()->find($hazard_id)->delete();

        return redirect()->back()->with('updateMess','Успешно удалено');
    }
}

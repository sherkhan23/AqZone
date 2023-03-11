<?php

namespace App\Http\Controllers;

use App\Models\Cultures;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CulturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cultures = Cultures::query()
            ->orderBy('culture_id', 'asc')
            ->paginate(6);
        Paginator::useBootstrap();
        return view('admin.cultures', compact('cultures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $culture = Cultures::query()->create([
            'cultureName' => $request['cultureName']
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
     * @param  \App\Models\Cultures  $cultures
     * @return \Illuminate\Http\Response
     */
    public function show(Cultures $cultures)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cultures  $cultures
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($culture_id, Request $request)
    {
        $culture = Cultures::query()->find($culture_id);
        $culture->cultureName = $request['cultureName'];
        $culture->save();
        return redirect()->back()->with('updateMess','Успешно сохранено');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cultures  $cultures
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cultures $cultures)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cultures  $cultures
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($culture_id)
    {
        $culture = Cultures::query()->find($culture_id)->delete();
        return redirect()->back()->with('updateMess','Успешно удалено');

    }
}

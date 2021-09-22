<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\CrudController;

class PlaceController extends CrudController
{

    public function index()
    {
        $places = Place::latest()->paginate(5);
        return view('places.index',compact('places'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $boats = Boat::where('enable', 1)->get();
        return view('places.create',compact('boats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'boat_id' => 'required',
        ]);

        Place::create($request->all());

        return redirect()->route('places.index')
                        ->with('success','Place created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        return view('places.show',compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        $boats = Boat::where('enable', 1)->get();
        return view('places.edit',compact('place','boats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
         request()->validate([
            'name' => 'required',
            'boat_id' => 'required',
        ]);

        $place->update($request->all());

        return redirect()->route('places.index')
                        ->with('success','Place updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $place->delete();

        return redirect()->route('places.index')
                        ->with('success','Place deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Itinerary;
use Illuminate\Http\Request;
use App\Http\Controllers\CrudController;
use App\Rules\Different;

class ItineraryController extends CrudController
{

    public function index()
    {
        $itineraries = Itinerary::latest()->paginate(10);
        return view('itineraries.index',compact('itineraries'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $counters = Counter::all();

        return view('itineraries.create',compact('counters'));
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
            'leaving' => ['required',new Different($request)],
            'arrival' => 'required',
            'national' => 'required|numeric',
            'foreigner' => 'required|numeric',
        ]);


        Itinerary::create($request->all());

        return redirect()->route('itineraries.index')
                        ->with('success','Itinerary created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function show(Itinerary $itinerary)
    {
        return view('itineraries.show',compact('itinerary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function edit(Itinerary $itinerary)
    {
        $counters = Counter::all();
        return view('itineraries.edit',compact('itinerary','counters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Itinerary $itinerary)
    {
         request()->validate([
            'leaving' => ['required',new Different($request)],
            'arrival' => 'required',
            'national' => 'required|numeric',
            'foreigner' => 'required|numeric',
        ]);

        $itinerary->update($request->all());

        return redirect()->route('itineraries.index')
                        ->with('success','Itinerary updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Itinerary $itinerary)
    {
        $itinerary->delete();

        return redirect()->route('itineraries.index')
                        ->with('success','Itinerary deleted successfully');
    }
}

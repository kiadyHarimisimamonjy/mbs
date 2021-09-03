<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Models\Travel;
use App\Rules\DateCheck;
use App\Models\Itinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itineraries = Itinerary::where('show','>', 0)->get();
       $inputs=  $request->all();
       $travettemp= Travel::where('id','>', 0);
     if( $request->input('itinerary') and $request->input('itinerary') !=='all' ){
        $travettemp = $travettemp->where('itinerary_id','=', $request->input('itinerary'));
       }
       if( $request->input('debut')){
        $travettemp = $travettemp->where('date','>=', $request->input('debut'));
       }
       if( $request->input('fin')){
        $travettemp = $travettemp->where('date','<=', $request->input('fin'));
       }
        $travels = $travettemp->paginate(5);
        return view('travels.index',compact('travels','inputs','itineraries'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itineraries = Itinerary::where('show','>', 0)->get();
        $boats = Boat::where('enable', 1)->get();
        return view('travels.create',compact('itineraries','boats'));
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
            'user_id' => 'required',
            'boat_id' => 'required',
            'canceled' => 'required',
            'date' =>['required',new DateCheck] ,
            'hour' => 'required',
            'itinerary_id' => 'required',
        ]);
       Travel::create($request->all());
        return redirect()->route('travels.index')
                        ->with('success','Place created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function show(Travel $travel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function edit(Travel $travel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Travel $travel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel)
    {
        //
    }
}

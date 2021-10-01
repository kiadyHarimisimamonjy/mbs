<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Boat;
use App\Models\User;
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
        $boats= Boat::where('enable','1')->get();
       $travels= Travel::getTravels( $request);
      // dd($travels);
        return view('travels.index',compact('travels','boats','itineraries'))
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
        $isadmin = User::isAdmin();
        $customers=$travel->activecustomers();
        return view('travels.show',compact('travel','customers','isadmin'));
       // ->with('i', (request()->input('page', 1) - 1) * 5);
     //   dd($travel->reservationispaid());
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
    public function postpone( $idtravel)
    {
        //
    }
    public function manifest(Travel $travel)
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function postponevalidate(Request $request,  $idtravel)
    {
        //
    }

    public function canceled( $idtravel)
    {    try {
        $travel = Travel::find( $idtravel);
        DB::transaction(function() use ($travel) {
            $travel->canceled();
        });
        return redirect()->route('travels.index')
        ->with('success','Annulation avec success');
    }
    catch (Exception $e) {

        return back()->withErrors($e->getMessage())->withInput();
    }
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

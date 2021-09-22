<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Boat;
use App\Models\Customer;
use App\Models\User;
use App\Models\Place;
use App\Models\Travel;
use App\Models\Itinerary;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itineraries = Itinerary::all();
       $reservations= Reservation::getReservations( $request);
      // dd($travels);
        return view('reservations.index',compact('reservations','itineraries'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getTravelsItinerary(Request $request) {
        try {
            $itinerary=json_decode($request->input('itinerary'));
            $parent=Itinerary::getParent($itinerary);
            $travels = Itinerary::getTravelForItinerary(  $parent->id,$request->input('boat'));
            return response()->json(array('travels'=> $travels), 200);
        }
        catch (Exception $e) {
            return response()->json($e, 500);
        }

     }
     public function getEnablePlaceTravel(Request $request) {
    try {
            $data=(array)json_decode($request->input('travel'));
            $travel = new Travel( $data);
            $travel->id= $data['id'];
             $places = $travel->getEnablePlaceTravel(  );
            return response()->json(array('places'=>  $places), 200);
        }
    catch (Exception $e) {
        return response()->json($e->getMessage() , 500);
    }

     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itineraries=User::getItineraryForUser();
        $boats= Boat::where('enable','1')->get();
        $js=['reservation'];
        return view('reservations.create',compact('itineraries','boats','js'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $data=($request->input('data'));
            $reservation=Reservation::create($data['info']);
           // $inputs= $request->all();
            foreach ($data['listclient'] as $value) {
                $customer = new Customer(($value));
                $customer->reservation()->associate($reservation);
                 $customer->save();

            }
            return response()->json( array('ok'=>'success'),200);
        }
        catch (Exception $e) {
            return response()->json( array('error'=>$e->getMessage()), 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}

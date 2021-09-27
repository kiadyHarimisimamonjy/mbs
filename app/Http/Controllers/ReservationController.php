<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Boat;
use App\Models\CanceledPaiement;
use App\Models\User;
use App\Models\Place;
use App\Models\Travel;
use App\Models\Customer;
use App\Models\Paiement;
use App\Models\Itinerary;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Rules\MontantValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        DB::beginTransaction();
        try {

            $data=($request->input('data'));
            $reservation=new Reservation($data['info']);
            if($data['action']==='saveandpaid') $reservation->ispaid=1;
            $reservation->save();

           // $inputs= $request->all();
            foreach ($data['listclient'] as $value) {
                $customer = new Customer($value);
                $customer->reservation()->associate($reservation);
                 $customer->save();
            }
            if($data['action']==='saveandpaid'){
                $paiedata=array('montant'=>$data['info']['total']);
                $paiement = new Paiement($paiedata);
                $paiement->user_id=Auth::user()->id;
                $paiement->reservation()->associate($reservation);
                $paiement->save();
             }
             DB::commit();
            return response()->json( array('ok'=>'success'),200);
        }
        catch (Exception $e) {
            DB::rollBack();
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
        $customers= $reservation->customers;
        $user= $reservation->user;
        $travel= $reservation->travel;
        $itinerary= $reservation->itinerary;
        $paiements= $reservation->paiements;
        $canceledpaiements= $reservation->canceledpaiements;

        $sumpaid = array_sum(array_column(json_decode(json_encode($paiements), true),
        'montant'));
         $unpaid= $reservation->total-$sumpaid;
        return view('reservations.show',compact('unpaid','canceledpaiements','sumpaid','itinerary','reservation','customers',
        'user','travel','paiements'));
    }
    public function print( $idreservation)
    {
        $reservation = Reservation::find( $idreservation);
        $placenb=count($reservation->customers) ;
        $user= $reservation->user;
        $travel= $reservation->travel;
        $itinerary= $reservation->itinerary;
        $paiements= $reservation->paiements;

        $sumpaid = array_sum(array_column(json_decode(json_encode($paiements), true),
        'montant'));
         $unpaid= $reservation->total-$sumpaid;
        return view('ticket',compact('unpaid','itinerary',
        'reservation','placenb',
        'travel'));
    }
    public function canceled( $idreservation)
    {

        DB::beginTransaction();
        try {
            $reservation = Reservation::find( $idreservation);
            $reservation->canceled = 1;
            $reservation->user_id=Auth::user()->id;
            $reservation->save();
            $paiements= $reservation->paiements;
            $sumpaid = array_sum(array_column(json_decode(json_encode($paiements), true),
            'montant'));
            $paiedata=array('montant'=>$sumpaid);
            $cpaiement = new CanceledPaiement($paiedata);
            $cpaiement->user_id=Auth::user()->id;
            $cpaiement->reservation()->associate($reservation);
            $cpaiement->save();
            DB::commit();
            return redirect()->route('reservations.index')
            ->with('success','Annulation avec success');
        }
        catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function paid(Request $request,  $idreservation)
    {
        DB::beginTransaction();
        try {
        request()->validate([
            'reste' => 'required',
            'montant' => ['required',new MontantValidation($request)],
           ]);
        $reservation = Reservation::find( $idreservation);
        if( $request->input('reste')===$request->input('montant')){
            $reservation->ispaid = 1;
            $reservation->save();
        }

        $paiedata=array('montant'=>$request->input('montant'));
        $paiement = new Paiement($paiedata);
        $paiement->user_id=Auth::user()->id;
        $paiement->reservation()->associate($reservation);
        $paiement->save();
        DB::commit();
        return redirect()->route('reservations.index')
        ->with('success','Paiement avec success');
    }
    catch (Exception $e) {
        DB::rollBack();
        return back()->withErrors('Verifiez bien le montant insere SVP')->withInput();
    }
        //
    }
/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function editPaid( $idreservation)
    {
         $reservation=Reservation::find($idreservation) ;
        $itinerary= $reservation->itinerary;
        $paiements= $reservation->paiements;

        $sumpaid = array_sum(array_column(json_decode(json_encode($paiements), true),
        'montant'));
         $unpaid= $reservation->total-$sumpaid;
        return view('reservations.paiement',compact('unpaid','sumpaid','itinerary'
        ,'reservation',
       'paiements'));
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

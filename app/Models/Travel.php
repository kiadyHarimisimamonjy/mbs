<?php

namespace App\Models;

use Exception;
use App\Models\Customer;
use App\Models\Itinerary;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Travel extends Model
{
    protected $table = 'Travels';
    use HasFactory;

    protected $fillable = [

        'hour', 'date',
        'user_id', 'boat_id',
        'itinerary_id','canceled'

    ];
    public function canceled()
    {
        $this->canceled = 1;
        $this->user_id=Auth::user()->id;
        $this->save();
        $reservations=$this->reservations;
        foreach(  $reservations as $reservation) $reservation->canceled();
    }
     public function buscustomers()
     {
     try{
           $search=$this->id;
             $itinerary_id=$this->itinerary_id;
           return Customer:: whereHas('reservation', function ($query) use ($search, $itinerary_id) {
           $query->where('travel_id', $search )->where('canceled',0)->where('itinerary_id',$itinerary_id);
           })->get();


           }
           catch (Exception $e) {
           echo($e->getMessage()) ;
           }

           }
    public function activecustomers($paginate=true)
    {
        try{
            $search=$this->id;
            if ($paginate){
                  return Customer:: whereHas('reservation', function ($query) use ($search) {
                  $query->where('travel_id', $search )->where('canceled',0);
                  })->paginate(5);
            }
            else{
                  return Customer:: whereHas('reservation', function ($query) use ($search) {
                  $query->where('travel_id', $search )->where('canceled',0);
                  })->get();
            }

        }
        catch (Exception $e) {
           echo($e->getMessage()) ;
        }

    }
    public function customers()
    {
        return $this->hasManyThrough(
            Customer::class,
            Reservation::class,
            'travel_id', // Foreign key on the environments table...
            'reservation_id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        );
    }
    public function reservationispaid()
    {

         if(count( $this->reservations()->where('ispaid',0)->get())===0) return 'complet';
        return'incomplet';
        }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }
    public static function getTravels(Request $request)
    {
        $travettemp= Travel::where('id','>', 0);
        if( $request->input('itinerary') and $request->input('itinerary') !=='all' ){
           $travettemp = $travettemp->where('itinerary_id','=', $request->input('itinerary'));
          }
          if( $request->input('boat') and $request->input('boat') !=='all' ){
            $travettemp = $travettemp->where('boat_id','=', $request->input('boat'));
           }
          if( $request->input('debut')){
           $travettemp = $travettemp->where('date','>=', $request->input('debut'));
          }
          if( $request->input('fin')){
           $travettemp = $travettemp->where('date','<=', $request->input('fin'));
          }
           $travels = $travettemp->orderBy('date', 'DESC')->paginate(5);
        return $travels;
    }

    public  function getEnablePlaceTravel()
    {
//DB::enableQueryLog();
        $reservations= $this->reservations()->where('canceled',0)->get();
      //  dd(DB::getQueryLog())  ;
        $data=[];
        $i=0;
        foreach($reservations as $reservation){
           $busies= Customer::where('reservation_id', $reservation['id'])->get();
           foreach($busies as $busy){
            $data[$i]=$busy['place_id'];
            $i++;
           }
        }

        return Place::whereNotIn('id',$data)->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }
}
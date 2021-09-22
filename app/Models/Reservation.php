<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'itinerary_id',
        'travel_id',
        'total',
        'tarification',
        'customer',
        'user_id',
        'contact',
        'number'

    ];
    public static function getReservations(Request $request)
    {
        $reservationtemp= Reservation::where('id','>', 0);
        if( $request->input('itinerary') and $request->input('itinerary') !=='all' ){
           $reservationtemp = $reservationtemp->where('itinerary_id','=', $request->input('itinerary'));
          }
          if( $request->input('nom')  ){
            $reservationtemp = $reservationtemp->where('customer','like','%'. $request->input('nom').'%');
           }
          if( $request->input('debut')){
           $reservationtemp = $reservationtemp->where('date','>=', $request->input('debut'));
          }
          if( $request->input('fin')){
           $reservationtemp = $reservationtemp->where('date','<=', $request->input('fin'));
          }
          $reservations = $reservationtemp->orderBy('created_at', 'DESC')->paginate(5);
          return $reservations;
    }

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }
    public function places()
    {
        return $this->belongsToMany(Place::class,'customers');
    }
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}

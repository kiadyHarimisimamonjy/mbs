<?php

namespace App\Models;

use App\Models\Counter;
use Illuminate\Http\Request;
use App\Models\CanceledPaiement;
use Illuminate\Support\Facades\Auth;
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
    public function canceled()
    {
        $this->canceled = 1;
        $this->user_id=Auth::user()->id;
        $this->save();
         $paiements=$this->paiements;
         $sumpaid = array_sum(array_column(json_decode(json_encode($paiements), true),
         'montant'));
         $paiedata=array('montant'=>$sumpaid);
         $cpaiement = new CanceledPaiement($paiedata);
         $cpaiement->user_id=Auth::user()->id;
         $counter= Counter:: where('id',Auth::user()->counter_id)->first('id');
         $cpaiement->counter_id=$counter->id;
         $cpaiement->reservation()->associate($this);
         $cpaiement->save();
    }
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
           $reservationtemp = $reservationtemp->where('created_at','>=', $request->input('debut'));
          }
          if( $request->input('fin')){
           $reservationtemp = $reservationtemp->where('created_at','<=', $request->input('fin'));
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

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
    public function canceledpaiements()
    {
        return $this->hasMany(CanceledPaiement::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckoutClose extends Model
{
    use HasFactory;
    public function checkout_open()
    {
    return $this->belongsTo(CheckoutOpen::class);
    }
      public function user()
      {
      return $this->belongsTo(User::class);
      }
    protected $fillable = [ 'montant' ,'derniermontant' ,'counter_id' ,'user_id','commentaire' ];
    public static function getCheckoutClose(Request $request,$isadmin=false)
    {

    $checkouttemp= CheckoutClose::where('id','>', 0);
   //  dd('wawa');
    if( $request->input('nom') ){
    $search=$request->input('nom') ;
    $checkouttemp = $checkouttemp->
    whereHas('user', function ($query) use ($search) {
    $query->where('name', 'like', '%' . $search . '%');
    });
    }
    if( $request->input('debut')){
    $checkouttemp = $checkouttemp->where('created_at','>=', $request->input('debut'));
    }
    if( $request->input('fin')){
    $checkouttemp = $checkouttemp->where('created_at','<=', $request->input('fin'));
        }
        if($isadmin){

        if( $request->input('counter') and $request->input('counter') !=='all' ){
             $search=$request->input('counter') ;
             $checkouttemp = $checkouttemp->
             whereHas('checkout_open', function ($query) use ($search) {
             $query->where('counter_id', $search );
             });
        }

        }
        if(!$isadmin){
            $counter= Counter:: where('id',Auth::user()->counter_id)->first('id');
            $search= $counter->id ;
            $checkouttemp = $checkouttemp->
            whereHas('checkout_open', function ($query) use ($search) {
            $query->where('counter_id', $search );
            });
            // dd( $checkouttemp);
        }
        $checkouts = $checkouttemp->orderBy('created_at', 'DESC')->paginate(5);
        return $checkouts;
        }
}
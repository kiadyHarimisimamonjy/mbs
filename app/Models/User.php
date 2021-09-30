<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    public static function isAdmin()
    {
        $roles= json_decode(Auth::user()->roles);
       $keys = array_column($roles, 'name');
       return !(array_search('Admin', $keys)===false);

    }
    public static function getTravelForUser()
    {
        $travel=null;
        $traveltemp=Travel::where('date','>=', date("Y-m-d"));
         if(Auth::user()->counter_id===0){
           return  $traveltemp ->orderBy('date', 'asc')->get();
         }
         else{
            $itineraryForUsers=User::getItineraryForUser();
            $traveltemp= $traveltemp->where('itinerary_id',  $itineraryForUsers[0]->id);
            for ($i = 1; $i < count($itineraryForUsers); $i++) {
                $traveltemp= $traveltemp->orWhere('itinerary_id',  $itineraryForUsers[$i]->id);
            }
            return $traveltemp ->orderBy('date', 'asc')->get();

         }

        return  $travel;
    }
    public static function getItineraryForUser()
    {
        if( User::isAdmin()){
            return Itinerary::all();
          }
        $city=Counter:: where('id',Auth::user()->counter_id)->first('city');
        return Itinerary::where('leaving',$city->city)->get();

    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}

<?php

namespace App\Models;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Itinerary extends Model
{
    use HasFactory;
    protected $fillable = [
        'arrival', 'leaving',
        'foreigner', 'national',
        'name'
    ];
    public function travels()
    {
        return $this->hasMany(Travel::class);
    }
    public static function getParent($itinerary)
    {
        return Itinerary::firstWhere('show', $itinerary->parent);
    }
    public static function getTravelForItinerary($itinerary_id,$boat_id)
    {
        return  Travel::where('itinerary_id',$itinerary_id)
        ->where('canceled','0')
        ->where('boat_id',$boat_id)
        ->where('date','>=',date("Y-m-d"))
        ->orderBy('date', 'asc')->get();
    }
}

<?php

namespace App\Models;

use App\Models\Itinerary;
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
    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
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

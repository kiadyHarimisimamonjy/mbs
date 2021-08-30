<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;
    protected $fillable = [

        'hour', 'date',
        'user_id', 'boat_id',
        'itinerary_id','canceled'

    ];
}

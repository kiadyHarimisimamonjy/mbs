<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'place_id' ,
        'cin' ,
        'age' ,
        'sexe' ,
        'name'
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
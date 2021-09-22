<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'boat_id'
    ];
    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class,'customers');
    }
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}

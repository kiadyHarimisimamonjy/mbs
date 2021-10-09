<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservation_id' ,
        'montant' ,
        'mode',
        'counter_id'
    ];
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function counter()
     {
     return $this->belongsTo(Counter::class);
     }
}
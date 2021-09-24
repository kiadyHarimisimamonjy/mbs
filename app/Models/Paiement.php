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
        'mode'
    ];
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}

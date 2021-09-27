<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanceledPaiement extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservation_id' ,
        'montant' ,
        'mode'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}

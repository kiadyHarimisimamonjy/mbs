<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionDepense extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id' ,
        'montant' ,
        'depense_id' ,
        'commentaire' ,
        'action'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function depense()
    {
        return $this->belongsTo(Depense::class);
    }
}

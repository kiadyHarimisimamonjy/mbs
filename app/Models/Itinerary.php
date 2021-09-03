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
}

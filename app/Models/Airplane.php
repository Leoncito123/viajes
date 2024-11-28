<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_airline'
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class, 'id_airline', 'id');
    }

    public function seats()
    {
        return $this->hasMany(Seat::class, 'id_airplane', 'id');
    }

    public function fly()
    {
        return $this->hasMany(Fly::class, 'id_fly', 'id');
    }

}

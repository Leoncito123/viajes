<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fly extends Model
{
    use HasFactory;

    protected $fillable = [
        'depature_date',
        'arrival_date',
        'fly_number',
        'fly_duration',
        'id_airplane',
        'id_destinies'
    ];

    public function seats()
    {
        return $this->hasManyThrough(Seat::class, Airplane::class, 'id', 'id_airplane', 'id_airplane', 'id');
    }

    public function airplane()
{
    return $this->belongsTo(Airplane::class, 'id_airplane', 'id');
}


    public function destinies()
    {
        return $this->belongsTo(Destiny::class, 'id_destinies', 'id');
    }

    public function passenger_flies()
    {
        return $this->hasMany(PassengerFly::class);
    }

    public function flyCosts()
    {
        return $this->hasMany(FlyCost::class, 'id_fly', 'id');
    }
}

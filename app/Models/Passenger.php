<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_names',
        'phone',
        'id_seat',
        'id_gender',
        'id_age'
    ];

    public function seats()
    {
        return $this->belongsTo(Seat::class);
    }

    public function clases()
    {
        return $this->belongsTo(Classe::class);
    }

    public function passengersfly()
    {
        return $this->hasMany(PassengerFly::class);
    }

    public function ages()
    {
        return $this->belongsTo(Age::class);
    }
}

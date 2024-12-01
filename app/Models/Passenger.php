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
        'id_age',
        'id_class'
    ];

<<<<<<< HEAD
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
=======
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'id_gender', 'id');
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class, 'id_seat', 'id');
    }

    public function age()
    {
        return $this->belongsTo(Age::class, 'id_age', 'id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_class', 'id');
    }


    public function passenger_flies()
    {
        return $this->hasMany(PassengerFly::class);
    }
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
}

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
}

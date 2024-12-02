<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'id_passenger_fly',
        'id_reservation',
        'id_user'
    ];

    public function passenger_flies()
    {
        return $this->belongsTo(PassengerFly::class, 'id_passenger_fly', 'id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id', 'id_reservation');
    }


    public function users()
    {
        return $this->hasMany(User::class, 'id_user', 'id');
    }

    public function paids()
    {
        return $this->hasMany(Paid::class, 'id_buy', 'id');
    }
}

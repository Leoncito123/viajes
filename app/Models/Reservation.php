<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_in',
        'check_out',
        'cant_kinds',
        'cant_adults',
        'cant_infants',
        'status_payment',
        'id_user_reservation'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    public function userreservations()
    {
        return $this->hasMany(UserReservation::class);
    }
}

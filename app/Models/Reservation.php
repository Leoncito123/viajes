<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
  use HasFactory;

<<<<<<< HEAD
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
=======
  protected $fillable = [
    'check_in',
    'check_out',
    'cant_adults',
    'cant_infants',
    'status_payment',
    'id_user_reservation',
    'id_room'
  ];

  public function room()
  {
    return $this->belongsTo(Room::class, 'id_room');
  }

  public function user()
  {
    return $this->belongsTo(User_Reservation::class, 'id_user_reservation');
  }

  public function buy()
  {
      return $this->belongsTo(Buy::class);
  }
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
}

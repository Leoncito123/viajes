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
}

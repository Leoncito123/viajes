<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Reservation extends Model
{
  use HasFactory;

  protected $table = 'user_reservations';

  protected $fillable = [
    'name',
    'last_names',
    'birthdate',
    'email',
    'phone',
    'id_gender',
  ];

  public function reservation()
  {
    return $this->hasMany(Reservation::class, 'id_user_reservation');
  }
}

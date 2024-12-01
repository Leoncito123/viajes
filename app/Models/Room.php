<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
  use HasFactory;

<<<<<<< HEAD
    protected $fillable = [
        'name',
        'price',
        'description',
        'status',
        'max_people',
        'id_hotel'
    ];

    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }
=======
  protected $fillable = [
    'name',
    'description',
    'status',
    'id_type_rooms',
    'id_hotel'
  ];

  public function type_room()
  {
    return $this->belongsTo(Type_room::class, 'id_type_rooms');
  }

  public function hotel()
  {
    return $this->belongsTo(Hotel::class, 'id_hotel');
  }

  public function reservations()
  {
    return $this->hasMany(Reservation::class, 'id_room');
  }
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
}

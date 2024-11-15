<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'phone',
    'stars',
    'town_center_distance',
    'politics',
    'id_services',
    'id_destiny'
  ];

  public function services()
  {
    return $this->belongsToMany(Service::class, 'services_hotels', 'id_hotels', 'id_services');
  }

  public function destiny()
  {
    return $this->belongsTo(Destiny::class, 'id_destiny');
  }

  public function pictures()
  {
    return $this->hasMany(Picture::class, 'id_hotel');
  }

  public function rooms()
  {
    return $this->hasMany(Room::class, 'id_hotel');
  }

  public function opinions()
  {
    return $this->hasMany(Opinion::class, 'id_hotel');
  }
}

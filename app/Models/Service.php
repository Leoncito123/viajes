<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'description',
  ];

  public function hotels()
  {
    return $this->belongsToMany(Hotel::class, 'services_hotels', 'id_services', 'id_hotels');
  }
}

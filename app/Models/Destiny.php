<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destiny extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'longitude',
    'latitude',
  ];

  public function flys(){
    return $this->hasMany(Fly::class);
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destiny extends Model
{
  use HasFactory;

<<<<<<< HEAD
    protected $fillable = [
        'name'
    ];

    public function flies()
    {
        return $this->hasMany(Fly::class);
    }
=======
  protected $fillable = [
    'name',
    'longitude',
    'latitude',
  ];

  public function fly()
  {
    return $this->hasMany(Fly::class, 'id_fly');
  }


  public function scales()
  {
    return $this->hasMany(Scale::class);
  }
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
}

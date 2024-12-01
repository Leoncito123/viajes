<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  use HasFactory;

<<<<<<< HEAD
    protected $fillable = [
        'name'
    ];

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class);
    }
=======
  protected $fillable = [
    'name',
    'description',
  ];

  public function hotels()
  {
    return $this->belongsToMany(Hotel::class, 'services_hotels', 'id_services', 'id_hotels');
  }
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
}

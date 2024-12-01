<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
  use HasFactory;

<<<<<<< HEAD
    protected $fillable = [
        'name',
        'id_hotel',
        'id_user'
    ];

    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }
=======
  protected $fillable = [
    'name',
    'id_hotel',
    'stars',
    'description',
    'id_user',
    'created_at',
  ];

  public function hotel()
  {
    return $this->belongsTo(Hotel::class, 'id_hotel');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'id_user');
  }
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
}

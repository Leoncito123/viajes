<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
  use HasFactory;

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
}

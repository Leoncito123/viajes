<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_room extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'description',
    'price',
    'max_people',
    'status'
  ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHotel extends Model
{
  use HasFactory;

  protected $table = 'services_hotels';

  protected $fillable = ['id_services', 'id_hotels'];
}

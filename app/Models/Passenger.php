<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_names',
        'phone',
        'id_seat',
        'id_gender',
        'id_age'
    ];
}

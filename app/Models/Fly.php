<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fly extends Model
{
    use HasFactory;

    protected $fillable = [
        'depature_date',
        'arrival_date',
        'fly_number',
        'fly_duration',
        'id_airplane',
        'id_destinies'
    ];
}

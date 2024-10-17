<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_in',
        'check_out',
        'cant_kinds',
        'cant_adults',
        'cant_infants',
        'status_payment',
        'id_user_reservation'
    ];
}

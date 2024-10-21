<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_names',
        'birthdate',
        'email',
        'phone',
        'id_gender'
    ];

    public function reservations()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

}

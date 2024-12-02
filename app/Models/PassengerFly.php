<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassengerFly extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_passenger',
        'if_fly'
    ];

    public function fly()
    {
        return $this->belongsTo(Fly::class, 'if_fly', 'id');
    }

    public function passenger()
    {
        return $this->belongsTo(Passenger::class, 'id_passenger');
    }

    public function buy()
    {
        return $this->hasMany(Buy::class);
    }
}

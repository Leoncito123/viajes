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

<<<<<<< HEAD
    public function airplanes()
    {
        return $this->belongsTo(Airplane::class);
    }

    public function destinies()
    {
        return $this->belongsTo(Destiny::class);
    }

    public function flyCosts()
    {
        return $this->hasMany(FlyCost::class);
=======
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function airplane()
    {
        return $this->belongsTo(Airplane::class, 'id_airplane', 'id');
    }

    public function destiny()
    {
        return $this->belongsTo(Destiny::class, 'id_destinies', 'id');
    }

    public function flycosts()
    {
        return $this->hasMany(FlyCost::class, 'id_fly', 'id');
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
    }

    public function scales()
    {
<<<<<<< HEAD
        return $this->hasMany(Scale::class);
    }

    public function passengerflys()
    {
        return $this->hasMany(PassengerFly::class);
=======
        return $this->hasMany(Scale::class, 'id_fly', 'id');
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
    }
}

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
    }

    public function scales()
    {
        return $this->hasMany(Scale::class);
    }

    public function passengerflys()
    {
        return $this->hasMany(PassengerFly::class);
    }
}

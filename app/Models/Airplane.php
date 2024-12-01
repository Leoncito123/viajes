<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_airline'
    ];

<<<<<<< HEAD
    public function airlines()
    {
        return $this->belongsTo(Airline::class);
=======
    public function airline()
    {
        return $this->belongsTo(Airline::class, 'id_airline', 'id');
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
    }

    public function seats()
    {
<<<<<<< HEAD
        return $this->hasMany(Seat::class);
    }

    public function flies()
    {
        return $this->hasMany(Fly::class);
    }
=======
        return $this->hasMany(Seat::class, 'id_airplane', 'id');
    }

    public function fly()
    {
        return $this->hasMany(Fly::class, 'id_fly', 'id');
    }

>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
}

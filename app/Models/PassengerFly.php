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

<<<<<<< HEAD
    public function passengers()
=======
    public function fly()
    {
        return $this->belongsTo(Fly::class, 'if_fly', 'id');
    }

    public function passenger()
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
    {
        return $this->belongsTo(Passenger::class);
    }

<<<<<<< HEAD
    public function flies()
    {
        return $this->belongsTo(Fly::class);
=======
    public function buy()
    {
        return $this->hasMany(Buy::class);
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
    }
}

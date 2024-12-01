<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'type'
    ];

<<<<<<< HEAD
=======
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
    public function flyCosts()
    {
        return $this->hasMany(FlyCost::class);
    }

<<<<<<< HEAD
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
=======
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

<<<<<<< HEAD
    public function users()
    {
        return $this->hasMany(User::class);
    }
=======
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
}

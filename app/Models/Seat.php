<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_airplane'
    ];

    public function airplane()
    {
<<<<<<< HEAD
        return $this->belongsTo(Airplane::class);
=======
        return $this->belongsTo(Airplane::class, 'id_airplane', 'id');
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
    }
}

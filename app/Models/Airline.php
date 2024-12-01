<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ubication'
    ];

    public function airplanes()
    {
        return $this->hasMany(Airplane::class);
    }
<<<<<<< HEAD

=======
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
}

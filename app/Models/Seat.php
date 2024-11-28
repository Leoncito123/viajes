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
        return $this->belongsTo(Airplane::class, 'id_airplane', 'id');
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
}

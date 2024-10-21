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

    public function flyCosts()
    {
        return $this->hasMany(FlyCost::class);
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
}

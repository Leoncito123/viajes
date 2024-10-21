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

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

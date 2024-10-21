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

    public function passengers()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function flies()
    {
        return $this->belongsTo(Fly::class);
    }
}

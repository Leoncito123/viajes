<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'stars',
        'town_center_distance',
        'politics',
        'id_services',
        'id_destiny'
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function destiny()
    {
        return $this->belongsTo(Destiny::class);
    }

    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}

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

    public function flycosts()
    {
        return $this->hasMany(FlyCost::class, 'id_class', 'id');
    }
}

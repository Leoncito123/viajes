<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlyCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost',
        'id_fly',
        'id_class'
    ];
}

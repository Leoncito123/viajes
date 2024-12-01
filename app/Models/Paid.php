<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paid extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_buy',
        'status',
        'cantidad',
        'buyer'
    ];

    public function buy()
    {
        return $this->belongsTo(Buy::class, 'id_buy', 'id');
    }
}

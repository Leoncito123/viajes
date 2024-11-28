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

    public function fly()
    {
        return $this->belongsTo(Fly::class, 'id_fly', 'id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_class', 'id');
    }
}

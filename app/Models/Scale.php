<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_fly',
        'id_destiny'
    ];

    public function fly()
    {
        return $this->belongsTo(Fly::class, 'id_fly', 'id');
    }

    public function destiny()
    {
        return $this->belongsTo(Destiny::class, 'id_destiny', 'id');
    }
}

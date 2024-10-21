<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'id_hotel'
    ];

    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }
}

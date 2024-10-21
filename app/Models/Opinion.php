<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_hotel',
        'id_user'
    ];

    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }
}

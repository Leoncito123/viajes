<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'max_number',
        'min_number'
    ];

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

}

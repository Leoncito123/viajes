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

<<<<<<< HEAD
    public function flies()
    {
        return $this->belongsTo(Fly::class);
=======
    public function fly()
    {
        return $this->belongsTo(Fly::class, 'id_fly', 'id');
    }

    public function destiny()
    {
        return $this->belongsTo(Destiny::class, 'id_destiny', 'id');
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
    }
}

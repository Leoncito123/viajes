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
<<<<<<< HEAD

    public function flies()
    {
        return $this->belongsTo(Fly::class);
    }

    public function classes()
    {
        return $this->belongsTo(Classe::class);
=======
    
    public function flycosts()
    {
        return $this->belongsTo(Seat::class);
    }

    public function fly()
    {
        return $this->belongsTo(Fly::class, 'id_fly', 'id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_class', 'id');
>>>>>>> ed7b8807b58514c8e72ef8d0a6a648df3fabcf4f
    }
}

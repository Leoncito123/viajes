<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controladorMich extends Controller
{
    public function inicioAdmin(){
        return view('mich.inicioAdmin');
    }

    public function reservaciones(){
        return view('mich.reservaciones');
    }
}

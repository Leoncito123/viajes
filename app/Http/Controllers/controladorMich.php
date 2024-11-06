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

    public function usuarios(){
        return view('mich.usuarios');
    }

    public function comentarios(request $request){
        $comentario=$request->input('coment');
        $nombre=$request->input('name');
        $titulo=$request->input('titulo');
        $hote=$request->input('hotel');

        session()->flash('titulo', 'Se registro con exito tu:'.$comentario);

        return view('mich.usuarios');
    }
}

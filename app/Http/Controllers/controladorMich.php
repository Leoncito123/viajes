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

    public function comentarios(Request $request)
{
    $request->validate([
        'comment' => 'required|string|max:500',
        'name' => 'required|string|max:100',
        'titulo' => 'required|string|max:100',
        'hotel' => 'required|string|max:100',
    ]);

    $comentario = $request->input('comment');
    $nombre = $request->input('name');
    $titulo = $request->input('titulo');
    $hotel = $request->input('hotel');

    session()->flash('exito', 'Se registró con éxito tu comentario');

    return view('mich.usuarios');
}
}

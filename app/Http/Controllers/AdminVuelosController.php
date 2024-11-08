<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminVuelosController extends Controller
{
    public function index()
    {
        return view('vuelos.adminVuelos');
    }


    public function storeVuelo(Request $request)
    {
        $validateData = $request->validate([
            'avion' => 'required',
            'destino' => 'required',
            'salida' => 'required',
            'llegada' => 'required',
            'NumVuelo' => 'required',
            'tiempoVuelo' => 'required',
        ]);

        session()->flash('nuevoVuelo', 'Nuevo Vuelo Registrado');

        return to_route('vuelos.adminVuelos');
    }

    public function costoAsignament(Request $request)
    {
        $validateData=$request->validate([
            'precio' => 'required',
            'clase' => 'required',
        ]);

        session()->flash('costo');

        return to_route('vuelos.adminVuelos');
    }
}

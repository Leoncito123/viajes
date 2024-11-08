<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VuelosController extends Controller
{
    public function main()
    {
        return view('vuelos.main');
    }

    public function index()
    {
        return view('vuelos.index');
    }

    public function show()
    {
        return view('vuelos.show');
    }

    public function reservationStore(Request $request)
    {
        $reservation = $request->validate([
            'name'=>'required',
            'last_name'=>'required',
            'phone'=>'required',
            'id_gender'=>'required',
            'id_seat'=>'required',
            'id_class'=>'required',
            'id_class'=>'required',
            'id_ages'=>'required',
        ]);

        $user = $request;

        session()->flash('reservacion', 'Reservación con Éxito'. $user);

        return view('vuelos.detail', compact('user'));

    }

    public function reservationShop(Request $request)
    {
        $buys = $request->validate([
            'compra'=>'required',
        ]);

        if($buys['compra'] == 1){
            $vuelo = 1;
        }else{
            $vuelo = 0;
        }

        return view('carritoCompras.canasta', compact('vuelo'));
    }
}

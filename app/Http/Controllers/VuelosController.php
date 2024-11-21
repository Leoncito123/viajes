<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fly;
use App\Models\Airplane;
use App\Models\Gender;
use App\Models\Classe;
use App\Models\Age;

class VuelosController extends Controller
{
    public function main()
    {
        return view('vuelos.main');
    }

    public function index()
    {
        $flies = Fly::all();

        return view('vuelos.index', compact('flies'));
    }

    public function show($id_fly)
    {
        $fly = Fly::findOrFail($id_fly);
        $genders = Gender::all();
        $classes = Classe::all();
        $ages = Age::all();
        $airplaneId = $fly->id_airplane;

        $airplane = Airplane::with('seats')->findOrFail($airplaneId);

        $seats = $airplane->seats->pluck('name');

        return view('vuelos.show', compact('fly', 'airplane', 'seats', 'genders', 'ages', 'airplane'));
    }

    public function reservationStore(Request $request)
    {
        $passenger = $request->validate([
            'name'=>'required',
            'last_name'=>'required',
            'phone'=>'required',
            'id_gender'=>'required',
            'id_seat'=>'required',
            'id_class'=>'required',
            'id_ages'=>'required',
        ]);

        Passenger::create([
            'name'=>$passenger['name'],
            'last_name'=>$passenger['last_name'],
            'phone'=>$passenger['phone'],
            'id_gender'=>$passenger['id_gender'],
            'id_seat'=>$passenger['id_seat'],
            'id_class'=>$passenger['id_class'],
            'id_ages'=>$passenger['id_ages'],
        ]);

        $passengerId = $passenger->id;

        $fly = Fly::findOrFail($id_fly);

        $this -> reservationFlyPassenger($passengerId, $id_fly);

        session()->flash('reservacion', 'Reservación con Éxito'. $user);

        return view('vuelos.detail', compact('user'));

    }

    public function reservationFlyPassenger($passengerId, $id_fly)
    {
        PassengerFly::create([
            'id_passenger' => $passengerId,
            'id_fly' => $id_fly
        ]);
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

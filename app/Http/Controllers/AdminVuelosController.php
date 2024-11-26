<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airline;
use App\Models\Classe;
use App\Models\Age;
use App\Models\Airplane;
use App\Models\Seat;
use App\Models\Destiny;
use App\Models\Fly;

class AdminVuelosController extends Controller
{
    public function index()
    {
        $airlines = Airline::all();
        $classes = Classe::all();
        $ages = Age::all();
        $airplanes = Airplane::with('airline', 'seats')->get();
        $destinies = Destiny::all();
        $flies = Fly::with('airplane', 'destiny')->get();

        return view('vuelos.adminVuelos', [
            'airlines'=>$airlines,
            'classes'=>$classes,
            'ages'=>$ages,
            'airplanes'=>$airplanes,
            'destinies'=>$destinies,
            'flies'=>$flies
        ]);
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

    public function storeAirlane(Request $request)
    {

        $validateData=$request->validate([
            'name'=>'required|string',
            'ubication'=>'required|string'
        ]);


        // dd($validateData);

        Airline::create([
            'name'=>$validateData['name'],
            'ubication'=>$validateData['ubication']
        ]);

        return back();
    }

    public function storeClass(Request $request)
    {
        $validateData=$request->validate([
            'type'=>'required|string'
        ]);

        Classe::create([
            'type'=>$validateData['type']
        ]);

        return back();
    }

    public function storeAge(Request $request)
    {
        $validateData = $request->validate([
            'name'=>'required',
            'max_number'=>'required|max:4',
            'min_number'=>'required|max:4',
        ]);

        Age::create([
            'name'=>$validateData['name'],
            'max_number'=>$validateData['max_number'],
            'min_number'=>$validateData['min_number'],
        ]);

        return back();
    }

    public function aiplaneStore(Request $request)
    {
        $validateData = $request->validate([
            'name'=>'required|string',
            'id_airline'=>'required|exists:airlines,id',
        ]);

        Airplane::create([
            'name'=>$validateData['name'],
            'id_airline'=>$validateData['id_airline']
        ]);

        return back();
    }

    public function seatStore(Request $request)
    {
        $validateData =  $request->validate([
            'name' => 'required|max:255',
            'id_airplane' => 'required|exists:airplanes,id'
        ]);

        $seatsNumber = (integer)$validateData['name'];

        for ($i=0; $i < $seatsNumber; $i++){
            Seat::create([
                'name'=>(string)$i,
                'id_airplane'=>$validateData['id_airplane']
            ]);
        }

        return back();
    }

    public function destinyStore(Request $request)
    {
        $validateData = $request->validate([
            'nombre' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        Destiny::create([
            'name' => $validateData['nombre'],
            'latitude' => $validateData['latitude'],
            'longitude' => $validateData['longitude'],
        ]);

        return back();
    }

    public function flyStore(Request $request)
    {
        $validateData = $request->validate([
            'id_airplane' => 'required|string',
            'id_destiny' => 'required|string',
            'depature_date' => 'required',
            'arrival_date' => 'required',
            'fly_number' => 'required',
            'fly_duration' => 'required',
        ]); 
        Fly::create([
            'id_airplane' => $validateData['id_airplane'],
            'id_destinies' => $validateData['id_destiny'],
            'depature_date' => $validateData['depature_date'],
            'arrival_date' => $validateData['arrival_date'],
            'fly_number' => $validateData['fly_number'],
            'fly_duration' => $validateData['fly_duration'],
        ]);

        return back();
    }

    public function costoStore(Request $request)
    {
        $validateData = $request->validate([
            'cost' => 'required',
            'id_class' => 'required',
            'id_fly' => 'required'
        ]);

        cost::create([
            'cost' => $validateData['cost'],
            'id_class' => $validateData['id_class'],
            'id_fly' => $validateData['id_fly']
        ]);
        return back();
    }
}

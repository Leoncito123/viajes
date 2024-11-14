<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airline;
use App\Models\Classe;
use App\Models\Age;
use App\Models\Airplane;
use App\Models\Seat;

class AdminVuelosController extends Controller
{
    public function index()
    {
        $airlines = Airline::all();
        $classes = Classe::all();
        $ages = Age::all();
        $airplanes = Airplane::with('airline', 'seats')->get();

        return view('vuelos.adminVuelos', [
            'airlines'=>$airlines,
            'classes'=>$classes,
            'ages'=>$ages,
            'airplanes'=>$airplanes
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

        Seat::create([
            'name'=>$validateData['name'],
            'id_airplane'=>$validateData['id_airplane']
        ]);

        return back();
    }
}

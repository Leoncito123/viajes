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
use App\Models\FlyCost;
use App\Models\Scale;



class AdminVuelosController extends Controller
{
    public function index()
    {
        $airlines = Airline::all();
        $classes = Classe::all();
        $ages = Age::all();
        $airplanes = Airplane::with('airline', 'seats')->get();
        $destinies = Destiny::all();
        $flies = Fly::with('airplane', 'destiny', 'flycosts.classe', 'scales')->get();
        $fliesCost = FlyCost::with('fly', 'classe')->get();

        return view('vuelos.adminVuelos', [
            'airlines' => $airlines,
            'classes' => $classes,
            'ages' => $ages,
            'airplanes' => $airplanes,
            'destinies' => $destinies,
            'flies' => $flies,
            'fliesCost' => $fliesCost,
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

    public function costoAsignament(Request $request, $id)
    {
        dd($request->all());
        $validateData = $request->validate([
            'precio' => 'required',
            'clase' => 'required',
            'id_fly' => 'required'
        ]);
        FlyCost::create([
            'cost' => $validatedData['precio'],
            'id_class' => $validatedData['clase'],
            'id_fly' => $validatedData['id_fly'],
        ]);
        session()->flash('costo');

        return to_route('vuelos.adminVuelos');
    }

    // public function escalaAsignament(Request $request)
    // {
    //     $validateData = $request->validate([
    //         'name' => 'required',
    //         'id_fly' => 'required'
    //     ]);
    //     FlyScale::create([
    //         'name' => $validatedData['name'],
    //         'id_fly' => $validatedData['id_fly'],
    //     ]);
    //     session()->flash('escala');

    //     return to_route('vuelos.adminVuelos');
    // }


    public function storeAirlane(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required|string',
            'ubication' => 'required|string'
        ]);


        // dd($validateData);

        Airline::create([
            'name' => $validateData['name'],
            'ubication' => $validateData['ubication']
        ]);

        return back();
    }

    public function updateAirline(Request $request, $id_airline)
    {
        $validateData = $request->validate([
            'name' => 'required|string',
            'ubication' => 'required|string',
        ]);

        $airline = Airline::findOrFail($id_airline);

        $airline->update([
            'name' => $validateData['name'],
            'ubication' => $validateData['ubication']
        ]);

        return back();
    }

    public function storeClass(Request $request)
    {
        $validateData = $request->validate([
            'type' => 'required|string'
        ]);
        Classe::create([
            'type' => $validateData['type']
        ]);

        return back();
    }

    public function storeAge(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'max_number' => 'required|max:4',
            'min_number' => 'required|max:4',
        ]);

        Age::create([
            'name' => $validateData['name'],
            'max_number' => $validateData['max_number'],
            'min_number' => $validateData['min_number'],
        ]);

        return back();
    }

    public function aiplaneStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string',
            'id_airline' => 'required|exists:airlines,id',
        ]);

        Airplane::create([
            'name' => $validateData['name'],
            'id_airline' => $validateData['id_airline']
        ]);

        return back();
    }

    public function seatStore(Request $request)
    {
        $validateData =  $request->validate([
            'name' => 'required|max:255',
            'id_airplane' => 'required|exists:airplanes,id'
        ]);

        $seatsNumber = (int)$validateData['name'];

        for ($i = 0; $i < $seatsNumber; $i++) {
            Seat::create([
                'name' => (string)$i,
                'id_airplane' => $validateData['id_airplane']
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
        try {
            $validateData = $request->validate([
                'id_airplane' => 'required|string',
                'id_destiny' => 'required|string',
                'depature_date' => 'required|date',
                'arrival_date' => 'required|date',
                'fly_number' => 'required|string',
                'fly_duration' => 'required|string',
                'classes' => 'required|array',
                'classes.*' => 'required|string',
                'scales' => 'required|array',
                'scales.*' => 'required|string',
                'costs' => 'required|array',
                'costs.*' => 'required|numeric',
            ]);

            Fly::create([
                'id_airplane' => $validateData['id_airplane'],
                'id_destinies' => $validateData['id_destiny'],
                'depature_date' => $validateData['depature_date'],
                'arrival_date' => $validateData['arrival_date'],
                'fly_number' => $validateData['fly_number'],
                'fly_duration' => $validateData['fly_duration'],
            ]);

            $fly = Fly::latest()->first();

            foreach ($validateData['classes'] as $index => $value) {
                FlyCost::create([
                    'cost' => $validateData['costs'][$index],
                    'id_class' => $value,
                    'id_fly' => $fly->id,
                ]);
            }

            foreach ($validateData['scales'] as $scale) {
                Scale::create([
                    'id_fly' => $fly->id,
                    'id_destiny' => $scale,
                ]);
            }

            return redirect()->route('vuelos.adminVuelos');
        } catch (\Exception $e) {
            \Log::error('Error en flyStore: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al guardar el vuelo.');
        }
    }

    public function costoStore(Request $request)
    {
        dump('Se creo');
        $validateData = $request->validate([
            'cost' => 'required',
            'id_class' => 'required',
            'id_fly' => 'required',
        ]);

        FlyCost::create([
            'cost' => $validateData['cost'],
            'id_class' => $validateData['id_class'],
            'id_fly' => $validateData['id_fly'],
        ]);
        return redirect()->route('vuelos.adminVuelos');
    }

    public function escalaStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
        ]);

        Scale::create([
            'name' => $validateData['name'],
        ]);

        return back();
    }

    public function editFly($id)
    {
        $airlines = Airline::all();
        $classes = Classe::all();
        $ages = Age::all();
        $airplanes = Airplane::with('airline', 'seats')->get();
        $destinies = Destiny::all();
        $fly = Fly::with('airplane', 'destiny', 'flycosts.classe', 'scales')->find($id);

        if (!$fly) {
            return redirect()->route('vuelos.adminVuelos')->with('error', 'Vuelo no encontrado.');
        }

        return view('vuelos.editVuelos', compact('airlines', 'classes', 'ages', 'airplanes', 'destinies', 'fly'));
    }

    public function updateVuelo(Request $request, $id)
    {

        $validateData = $request->validate([
            'id_airplane' => 'required|string',
            'id_destiny' => 'required|string',
            'depature_date' => 'required|date',
            'arrival_date' => 'required|date',
            'fly_number' => 'required|string',
            'fly_duration' => 'required|string',
            'classes' => 'required|array',
            'classes.*' => 'required|string',
            'scales' => 'required|array',
            'scales.*' => 'required|string',
            'costs' => 'required|array',
            'costs.*' => 'required|numeric',
        ]);

        $fly = Fly::find($id);

        if (!$fly) {
            return redirect()->route('vuelos.adminVuelos')->with('error', 'Vuelo no encontrado.');
        }

        $fly->update([
            'id_airplane' => $validateData['id_airplane'],
            'id_destinies' => $validateData['id_destiny'],
            'depature_date' => $validateData['depature_date'],
            'arrival_date' => $validateData['arrival_date'],
            'fly_number' => $validateData['fly_number'],
            'fly_duration' => $validateData['fly_duration'],
        ]);

        $fly->flycosts()->delete();
        foreach ($validateData['classes'] as $index => $value) {
            FlyCost::create([
                'cost' => $validateData['costs'][$index],
                'id_class' => $value,
                'id_fly' => $fly->id,
            ]);
        }

        $fly->scales()->delete();
        foreach ($validateData['scales'] as $scale) {
            Scale::create([
                'id_fly' => $fly->id,
                'id_destiny' => $scale,
            ]);
        }

        return redirect()->route('vuelos.adminVuelos')->with('success', 'Vuelo actualizado correctamente.');
    }

    public function deleteFly($id)
    {
        $fly = Fly::findOrFail($id);
        
        $fly->flycosts()->delete();
        $fly->scales()->delete();
        
        $fly->delete();

        return redirect()
            ->route('vuelos.adminVuelos')
            ->with('success', 'Vuelo eliminado correctamente.');
    }
}

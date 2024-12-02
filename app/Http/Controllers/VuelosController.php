<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Fly;
use App\Models\Airplane;
use App\Models\Gender;
use App\Models\Classe;
use App\Models\Age;
use App\Models\Destiny;
use App\Models\Passenger;
use App\Models\PassengerFly;
use App\Models\Seat;
use App\Models\Airline;
use App\Models\Buy;

class VuelosController extends Controller
{
    public function main()
    {
        $destinos = Destiny::all();
        $airlines = Airline::all();

        return view('vuelos.main', compact('destinos', 'airlines'));
    }

    public function searchFlights(Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'airline' => 'nullable|string|max:255',
            'destination' => 'required|string|max:255',
            'depature_date' => 'required|date',
            'arrival_date' => 'nullable|date',
            'fly_number' => 'nullable|numeric',
            'cant_pasajeros' => 'required|integer',
        ]);


        $flights = Fly::query();


        if (!empty($validated['airline'])) {
            $flights->whereHas('airplane.airline', function ($query) use ($validated) {
                $query->where('name', $validated['airline']);
            });
        }

        $flights->whereHas('destiny', function ($query) use ($validated) {
            $query->where('name', $validated['destination']);
        });


        $flights->whereDate('depature_date', $validated['depature_date']);


        if (!empty($validated['arrival_date'])) {
            $flights->whereDate('arrival_date', $validated['arrival_date']);
        }


        if (!empty($validated['fly_number'])) {
            $flights->where('fly_number', $validated['fly_number']);
        }

        $flies = $flights->get();

        $flies->each(function ($fly) {
            $fly->seat_count = $fly->airplane->seats->count();
        });

        $airline = $validated['airline'] ?? null;
        $destiny = $validated['destination'];
        $date = $validated['depature_date'];
        $cant_pasajeros = $validated['cant_pasajeros'];

        $cant_forms = $cant_pasajeros;

        return view('vuelos.index', compact('flies', 'airline', 'destiny', 'date', 'cant_pasajeros', 'cant_forms'));
    }

    public function index()
    {
        $flies = Fly::all();

        return view('vuelos.index', compact('flies'));
    }

    public function show($id_fly, $cant_pasajeros)
    {
        $cant_forms = $cant_pasajeros;

        $fly = Fly::findOrFail($id_fly);
        $genders = Gender::all();
        $classes = Classe::all();
        $ages = Age::all();
        $airplaneId = $fly->id_airplane;

        $airplane = Airplane::with('seats')->findOrFail($airplaneId);

        $seats = $airplane->seats;

        $seatsOcupados = $airplane->seats()->where('status', 0)->get();


        return view('vuelos.show', compact('fly', 'airplane', 'seats', 'seatsOcupados', 'genders', 'ages', 'airplane', 'classes', 'cant_forms'));
    }

    public function reservationStore(Request $request)
    {
        // Validar que los datos de los formularios sean correctos
        $validatedData = $request->validate([
            'id_fly' => 'required|exists:flies,id', // Validar que el vuelo exista
            'name.*' => 'required|string', // Validar cada nombre
            'last_names.*' => 'required|string', // Validar cada apellido
            'phone.*' => 'required|string', // Validar cada número de teléfono
            'id_gender.*' => 'required|exists:genders,id', // Validar cada género
            'id_seat.*' => 'required|exists:seats,id', // Validar cada asiento
            'id_class.*' => 'required|exists:classes,id', // Validar cada clase
            'id_age.*' => 'required|integer', // Validar cada edad
        ]);

        $id_fly = $validatedData['id_fly'];
        $createdPassengerIds = []; // Arreglo para almacenar los IDs de los pasajeros

        // Usar una transacción para asegurar la consistencia de los datos
        DB::transaction(function () use ($validatedData, $id_fly, &$createdPassengerIds) {
            foreach ($validatedData['name'] as $index => $name) {
                // Crear el pasajero con los datos validados
                $passenger = Passenger::create([
                    'name' => $name,
                    'last_names' => $validatedData['last_names'][$index],
                    'phone' => $validatedData['phone'][$index],
                    'id_gender' => $validatedData['id_gender'][$index],
                    'id_seat' => $validatedData['id_seat'][$index],
                    'id_class' => $validatedData['id_class'][$index],
                    'id_age' => $validatedData['id_age'][$index],
                ]);

                // Guardar el ID del pasajero recién creado
                $createdPassengerIds[] = $passenger->id;

                // Relacionar el pasajero con el vuelo
                PassengerFly::create([
                    'id_passenger' => $passenger->id,
                    'if_fly' => $id_fly
                ]);
            }
        });

        $seatIds = $validatedData['id_seat']; // Obtener todos los ID de asientos
        foreach ($seatIds as $seatId) {
            // Actualizar el estado del asiento a 1 (ocupado)
            $seat = Seat::find($seatId);
            if ($seat) {
                $seat->status = 1; // 1 representa que el asiento está ocupado
                $seat->save(); // Guardar los cambios
            }
        }

        $createdPassengers = Passenger::with(['seat', 'classe', 'age'])
            ->whereIn('id', $createdPassengerIds)
            ->get();

        $id_user = Auth::id();

        foreach ($createdPassengers as $passenger) {
            $passengerFly = PassengerFly::where('id_passenger', $passenger->id)
                ->where('if_fly', $id_fly)
                ->first();

            if ($passengerFly) {
                Buy::create([
                    'id_passenger_fly' => $passengerFly->id,
                    'id_user' => $id_user
                ]);
            }
        }

        return to_route('compras');
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

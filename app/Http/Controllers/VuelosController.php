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
            'airline' => 'nullable|string|max:255', // Aerolínea opcional
            'destination' => 'required|string|max:255', // Destino obligatorio
            'depature_date' => 'required|date', // Fecha de salida obligatoria
            'arrival_date' => 'nullable|date', // Fecha de llegada opcional
            'fly_number' => 'nullable|numeric', // Número de vuelo opcional
            'cant_pasajeros' => 'required|integer', // Cantidad de pasajeros opcional
        ]);

        // Construir la consulta
        $flights = Fly::query();

        // Filtrar por aerolínea si se proporciona
        if (!empty($validated['airline'])) {
            $flights->whereHas('airplane.airline', function ($query) use ($validated) {
                $query->where('name', $validated['airline']);
            });
        }

        // Filtrar por destino
        $flights->whereHas('destinies', function ($query) use ($validated) {
            $query->where('name', $validated['destination']);
        });

        // Filtrar por fecha de salida
        $flights->whereDate('depature_date', $validated['depature_date']);

        // Filtrar por fecha de regreso si se proporciona
        if (!empty($validated['arrival_date'])) {
            $flights->whereDate('arrival_date', $validated['arrival_date']);
        }

        // Filtrar por número de vuelo si se proporciona
        if (!empty($validated['fly_number'])) {
            $flights->where('fly_number', $validated['fly_number']);
        }

        // Obtener los vuelos
        $flies = $flights->get();

        // Agregar la cantidad de asientos disponibles para cada vuelo
        $flies->each(function ($fly) {
            // Obtener la cantidad total de asientos relacionados al vuelo
            $fly->seat_count = $fly->airplane->seats->count();
        });

        // Retornar la vista con los datos
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


        return view('vuelos.show', compact('fly', 'airplane', 'seats', 'genders', 'ages', 'airplane', 'classes', 'cant_forms'));
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

        // Recuperar todos los registros recién creados
        $createdPassengers = Passenger::with(['seat', 'classe', 'age']) // Cargar relaciones necesarias
            ->whereIn('id', $createdPassengerIds) // Filtrar por los IDs recién creados
            ->get();

        $id_user = Auth::id();

        foreach ($createdPassengers as $passenger) {
            // Obtener el registro correspondiente en PassengerFly
            $passengerFly = PassengerFly::where('id_passenger', $passenger->id)
                ->where('if_fly', $id_fly)  // Asegurarse de que esté relacionado con el vuelo correcto
                ->first();

            if ($passengerFly) {
                // Crear el registro de Buy utilizando el id de PassengerFly
                Buy::create([
                    'id_passenger_fly' => $passengerFly->id,  // Usar el id de PassengerFly
                    'id_user' => $id_user
                ]);
            } else {
                // Aquí puedes manejar el caso si no se encuentra PassengerFly (aunque debería encontrarse)
                // Podrías lanzar un error o hacer un log para depurar
            }
        }

        $userId = auth()->id();
        // Obtener las compras del usuario logueado con las relaciones necesarias
        $compras = Buy::where('id_user', $userId)
                      ->where('status', 0) // Filtrar por status 0
                      ->with('passenger_flies.fly.flyCosts') // Cargar las relaciones necesarias
                      ->get();
        // Mensaje de éxito
        session()->flash('reservacion', 'Reservación realizada con éxito.');

        $costoTotal = 0;

            foreach($compras as $compra)
            {
                // Obtener el costo del vuelo (el primer costo relacionado)
                $costoVuelo = $compra->passenger_flies->fly->flyCosts->first()->cost;
               // Acumular el costo del vuelo en el costo total
                $costoTotal += $costoVuelo;
            }



        // Redirigir a la vista de detalles del vuelo con los registros completos
        return view('carritoCompras.canasta', compact('compras', 'costoTotal'));
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

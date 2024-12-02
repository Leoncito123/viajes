<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buy;
use App\Models\Fly;
use App\Models\Paid;

class PayController extends Controller
    {

public function index()
{
    // Obtener el ID del usuario logueado
    $userId = auth()->id();

    $compras = Buy::where('id_user', $userId)
    ->where('status', 0)
    ->with([
        'passenger_flies.passenger',
        'passenger_flies.fly.flyCosts',
        'passenger_flies.fly.airplane',
        'reservations.room.type_room',
        'paids',
    ])
    ->get();



        $costoTotal = 0;

    foreach ($compras as $compra) {
        // Verificamos si la compra tiene un vuelo y si el vuelo tiene costos
        if ($compra->passenger_flies && $compra->passenger_flies->fly && $compra->passenger_flies->fly->flyCosts->isNotEmpty()) {
            $costoVuelo = $compra->passenger_flies->fly->flyCosts->first()->cost;
            $costoTotal += $costoVuelo;
        }

        // Verificamos si la compra tiene reservaciones y si estas tienen habitaciones
        if ($compra->reservations) {
            foreach ($compra->reservations as $reserva) {
                // Ignoramos la reservación si su estado es 1 (pagada o no válida)
                if ($reserva->status != 1 && $reserva->room && $reserva->room->type_room) {
                    // Añadimos el costo de la habitación
                    $costoHabitacion = $reserva->room->type_room->price;
                    $costoTotal += $costoHabitacion;
                }
            }
        }
    }

    return view('carritoCompras.pay', compact('costoTotal', 'compras'));
}

public function canasta3()
{
    $userId = auth()->id();

    $compras = Buy::where('id_user', $userId)
    ->where('status', 0)
    ->with([
        'passenger_flies.passenger',
        'passenger_flies.fly.flyCosts',
        'passenger_flies.fly.airplane',
        'reservations.room.type_room',
        'paids',
    ])
    ->get();


    $costoTotal = 0;

    foreach ($compras as $compra) {
        // Verificamos si la compra tiene un vuelo y si el vuelo tiene costos
        if ($compra->passenger_flies && $compra->passenger_flies->fly && $compra->passenger_flies->fly->flyCosts->isNotEmpty()) {
            $costoVuelo = $compra->passenger_flies->fly->flyCosts->first()->cost;
            $costoTotal += $costoVuelo;
        }

        // Verificamos si la compra tiene reservaciones y si estas tienen habitaciones
        if ($compra->reservations) {
            foreach ($compra->reservations as $reserva) {
                // Ignoramos la reservación si su estado es 1 (pagada o no válida)
                if ($reserva->status != 1 && $reserva->room && $reserva->room->type_room) {
                    // Añadimos el costo de la habitación
                    $costoHabitacion = $reserva->room->type_room->price;
                    $costoTotal += $costoHabitacion;
                }
            }
        }
    }



    return view('carritoCompras.canasta', compact('compras', 'costoTotal'));
}

public function pagar(Request $request)
{
    $payment = $request->validate([
        'buyer' => 'required',
        'cardNumber' => 'required',
        'expMonth' => 'required',
        'expYear' => 'required',
        'cvv' => 'required|max:3|min:3',
    ]);

    $userId = auth()->id();

    $compras = Buy::where('id_user', $userId)
    ->where('status', 0)
    ->with([
        'passenger_flies.passenger',
        'passenger_flies.fly.flyCosts',
        'passenger_flies.fly.airplane',
        'reservations.room.type_room',
        'paids',
    ])
    ->get();

    foreach($compras as $compra){
        Buy::findOrfail($compra->id)->update(['status'=>1]);
    }

    return back();
}

public function canasta2()
{
    $userId = auth()->id();

    $vuelos = Buy::where('id_user', $userId)
    ->where('status', 0)
    ->whereHas('paids', function ($query) {
        $query->whereNotNull('id');
    })

    ->with([
        'passenger_flies.passenger',
        'passenger_flies.fly.flyCosts',
        'passenger_flies.fly.airplane',
        'paids'
    ])
    ->get();

    $reservaciones = Buy::where('id_user', $userId)
        ->where('status', 0)
        ->whereHas('reservations', function ($query) {
            // Puedes agregar condiciones específicas para 'reservations' aquí si es necesario
            $query->whereNotNull('id'); // Ejemplo: solo incluye reservaciones existentes
        })
        ->with([
            'reservations.room.type_room',
            'paids'
        ])
        ->get();


                        $costoTotal = 0;
                        $detallesCompras = [];

                        foreach ($vuelos as $compra) {
                            $costoVuelo = 0;

                            // Verificar que el vuelo no tenga un estado 1 (no se debe contar)
                            if ($compra->passenger_flies &&
                                $compra->passenger_flies->fly &&
                                $compra->passenger_flies->fly->flyCosts->isNotEmpty() &&
                                $compra->passenger_flies->fly->status != 1) {  // Añadido el chequeo de estado
                                $costoVuelo = $compra->passenger_flies->fly->flyCosts->first()->cost;
                            }

                            $costoTotal += $costoVuelo;

                            $detallesCompras[] = [
                                'compra_id' => $compra->id,
                                'costoVuelo' => $costoVuelo,
                                'costoHabitacion' => 0,
                                'totalCompra' => $costoVuelo,
                            ];
                        }

                        foreach ($reservaciones as $compra) {
                            $costoHabitacion = 0;

                            if ($compra->reservations) {
                                foreach ($compra->reservations as $reserva) {
                                    // Ignorar la reservación si su estado es 1
                                    if ($reserva->status != 1 && $reserva->room && $reserva->room->type_room) {  // Añadido el chequeo de estado
                                        $costoHabitacion = $reserva->room->type_room->price;
                                    }
                                }
                            }

                            $costoTotal += $costoHabitacion;

                            $detallesCompras[] = [
                                'compra_id' => $compra->id,
                                'costoVuelo' => 0,
                                'costoHabitacion' => $costoHabitacion,
                                'totalCompra' => $costoHabitacion,
                            ];
                        }


    $vuelosPagados = Buy::where('id_user', $userId)
    ->where('status', 0)
    ->with('paids') // Solo cargamos paids
    ->get();

    return view('carritoCompras.canasta', compact('detallesCompras', 'costoTotal', 'reservaciones', 'vuelos', 'vuelosPagados'));
}

public function pay(Request $request)
{

    $payment = $request->validate([
        'buyer' => 'required',
        'cardNumber' => 'required',
        'expMonth' => 'required',
        'expYear' => 'required',
        'cvv' => 'required|max:3|min:3',
    ]);

    $userId = auth()->id();

    // Obtener las compras de vuelos del usuario logueado
    $vuelos = Buy::where('id_user', $userId)
    ->where('status', 0)
    ->whereHas('paids', function ($query) {
        $query->whereNull('id');
    })
    ->with([
        'passenger_flies.passenger',
        'passenger_flies.fly.flyCosts',
        'passenger_flies.fly.airplane',
        'paids'
    ])
    ->get();

    // Obtener las compras de reservaciones del usuario logueado
    $reservaciones = Buy::where('id_user', $userId)
    ->where('status', 0)
    ->whereHas('reservations', function ($query) {
        // Puedes agregar condiciones específicas para 'reservations' aquí si es necesario
        $query->whereNull('id'); // Ejemplo: solo incluye reservaciones existentes
    })
    ->with([
        'reservations.room.type_room',
        'paids'
    ])
    ->get();

    $costoTotal = 0;

    // Calcular el costo de los vuelos y registrar los pagos
    foreach ($vuelos as $compra) {
        $costoVuelo = 0;

        if ($compra->passenger_flies &&
            $compra->passenger_flies->fly &&
            $compra->passenger_flies->fly->flyCosts->isNotEmpty()) {
            $costoVuelo = $compra->passenger_flies->fly->flyCosts->first()->cost;
        }

        // Actualizar el estado de la compra a 1 (pagado)

        $costoTotal += $costoVuelo;

        // Registrar el pago del vuelo
        Paid::create([
            'id_buy' => $compra->id,
            'cantidad' => $costoVuelo,
            'buyer' => $payment['buyer'],
        ]);
        $compra->update(['status' => 1]);

    }

    // Calcular el costo de las habitaciones y registrar los pagos
    foreach ($reservaciones as $compra) {
        $costoHabitacion = 0;

        if ($compra->reservations) {
            foreach ($compra->reservations as $reserva) {
                if ($reserva->room && $reserva->room->type_room) {
                    $costoHabitacion = $reserva->room->type_room->price;
                }
            }
        }

        $costoTotal += $costoHabitacion;

        // Registrar el pago de la reservación
        Paid::create([
            'id_buy' => $compra->id,
            'cantidad' => $costoHabitacion,
            'buyer' => $payment['buyer'],
        ]);

    }



    // Mensaje de éxito
    session()->flash('pagado', 'Se hizo el Pago con Éxito');

    // Redirigir a la ruta 'pay'
    return to_route('pay', compact('vuelos'));
}


        public function deleteCarrito($buy_id)
        {
            $buy = Buy::findOrFail($buy_id);

            $buy->delete();

            return to_route('compras');
        }
}

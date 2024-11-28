<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Passenger;
use App\Models\PassengerFly;
use App\Models\Fly;
use App\Models\User;
use App\Models\Paid;
use App\Models\Buy;

class FlyReservationController extends Controller
{
    public function store(Request $request)
    {

        $validateData = $request->validate([
            'id_fly' => 'required',
            'name'=> 'required',
            'last_names'=> 'required',
            'phone'=> 'required',
            'id_seat'=> 'required|string',
            'id_gender'=> 'required|string',
            'id_age'=> 'required|string',
            'id_class'=>'required|string'
        ]);

        $passenger = Passenger::create([
            'name'=>$validateData['name'],
            'last_names'=>$validateData['last_names'],
            'phone'=>$validateData['phone'],
            'id_seat'=>$validateData['id_seat'],
            'id_gender'=>$validateData['id_gender'],
            'id_age'=>$validateData['id_age'],
            'id_class'=>$validateData['id_class'],
        ]);

        $pasengerId = $passenger->id;

        $fly_id = $request['id_fly'];

        $fly = Fly::findOrFail($fly_id);

        $passengerFlyData = $this->passengerFly($fly_id, $pasengerId);

        return view('vuelos.detail', compact('passenger', 'fly', 'passengerFlyData'));
    }

    public function passengerFly($fly_id, $pasengerId)
    {
        $id_pasenger = Passenger::findOrFail($pasengerId);
        $id_fly = Fly::findOrFail($fly_id);

        $passengerFly = PassengerFly::create([
            'id_passenger'=>$id_pasenger->id,
            'if_fly'=>$id_fly->id
        ]);

        return ($passengerFly);
    }

    public function addCarrito(Request $request)
    {
        $validateData = $request->validate([
            'id_passenger_fly' => 'required|array', // Asegúrate de que sea un arreglo
            'id_passenger_fly.*' => 'required|integer|exists:passenger_flies,id', // Verifica que existan en la tabla de passenger_flies
        ]);

        $id_user = Auth::id(); // Obtiene el ID del usuario autenticado

        // Utiliza una transacción para asegurar la integridad de los datos
        DB::transaction(function () use ($validateData, $id_user) {
            foreach ($validateData['id_passenger_fly'] as $passengerId) {
                Buy::create([
                    'id_passenger_fly' => $passengerId,
                    'id_user' => $id_user,
                ]);
            }
        });

        return to_route('dashboard'); // Redirige después de crear los registros
    }

    public function pay(Request $request)
        {
            $payment = $request->validate([
                'buyer' => 'required',
                'cardNumber' => 'required',
                'expMonth' => 'required',
                'expYear' => 'required',
                'cvv' => 'required',
            ]);

            $userId = auth()->id();
            // Obtener las compras del usuario logueado con las relaciones necesarias
            $compras = Buy::where('id_user', $userId)
                          ->where('status', 0) // Filtrar por status 0
                          ->with('passenger_flies.fly.flyCosts') // Cargar las relaciones necesarias
                          ->get();

            $costoTotal = 0;

            foreach($compras as $compra)
            {
                // Obtener el costo del vuelo (el primer costo relacionado)
                $costoVuelo = $compra->passenger_flies->fly->flyCosts->first()->cost;
               // Acumular el costo del vuelo en el costo total
                $costoTotal += $costoVuelo;
            }


            foreach($compras as $compra)
            {
                Paid::create([
                    'id_buy'=>$compra->id,
                    'cantidad'=>$costoTotal,
                    'buyer'=>$payment['buyer'],
                ]);
            }

            session()->flash('pagado', 'Se hizo el Pago con Exito');

            return to_route('pay');
        }

}

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

            return view('carritoCompras.pay', compact('costoTotal'));
        }

        public function pay(Request $request)
        {
            $payment = $request->validate([
                'buyyer' => 'required',
                'cardNumber' => 'required',
                'expMonth' => 'required',
                'expYear' => 'required',
                'cvv' => 'required|max:3|min:3',
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


        public function canasta()
        {
            // Obtener el ID del usuario logueado
            $userId = auth()->id();

            $compras = Buy::where('id_user', $userId)
                          ->where('status', 0)
                          ->with('passenger_flies.fly.flyCosts')
                          ->get();

            $costoTotal = 0;

            foreach($compras as $compra)
            {
                // Obtener el costo del vuelo (el primer costo relacionado)
                $costoVuelo = $compra->passenger_flies->fly->flyCosts->first()->cost;
               // Acumular el costo del vuelo en el costo total
                $costoTotal += $costoVuelo;
            }

            $pagados = Buy::whereHas('paids', function ($query) {
                $query->where('status', 1); // Filtra registros en `paids` donde `status = 1`
            })->with('paids') // Carga los registros relacionados de `paids`
            ->get();

            // $costosCompras = [];

            // // Iterar sobre las compras para calcular el costo de cada vuelo
            // foreach ($compras as $compra) {
            //     $costoTotal = 0;

            //     // Obtener el registro de passenger_fly relacionado
            //     $passengerFly = $compra->passenger_flies;

            //     if ($passengerFly && $passengerFly->fly) {
            //         // Sumar los costos desde la colección flyCosts
            //         foreach ($passengerFly->fly->flyCosts as $flyCost) {
            //             $costoTotal += $flyCost->cost;
            //         }
            //     }

            //     // Guardar los datos en el array de resultados
            //     $costosCompras[] = [
            //         'compra' => $compra,
            //         'costoVuelo' => $costoTotal,
            //     ];
            // }

            // // Depurar para verificar los resultados
            // dd($costosCompras);

            // Retornar la vista con los datos procesados
            return view('carritoCompras.canasta', compact('compras', 'costoTotal'));
        }

        public function deleteCarrito($buy_id)
        {
            $buy = Buy::findOrFail($buy_id);

            $buy->delete();

            return back();
        }
}

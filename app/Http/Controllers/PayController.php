<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayController extends Controller
{
    public function index()
    {
        return view('carritoCompras.pay');
    }

    public function pay(Request $request)
    {
        $payment = $request->validate([
            'cardName' => 'required',
            'cardNumber' => 'required',
            'expMonth' => 'required',
            'expYear' => 'required',
            'cvv' => 'required',
        ]);

        $paymentUser = $request['cardName'];

        session()->flash('pagado', 'Se hizo el Pago con Exito');

        return to_route('pay');
    }

    public function canasta()
    {
        return view('carritoCompras.canasta');
    }
}

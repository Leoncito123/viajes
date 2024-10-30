<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayController extends Controller
{
    public function index()
    {
        return view('carritoCompras.pay');
    }

    public function canasta()
    {
        return view('carritoCompras.canasta');
    }
}

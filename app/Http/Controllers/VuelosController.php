<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VuelosController extends Controller
{
    public function main()
    {
        return view('vuelos.main');
    }

    public function index()
    {
        return view('vuelos.index');
    }

    public function show()
    {
        return view('vuelos.show');
    }
}

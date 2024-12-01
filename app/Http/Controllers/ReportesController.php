<?php

namespace App\Http\Controllers;

use App\Models\Destiny;
use App\Models\Fly;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Service;
use App\Models\Type_room;
use App\Models\User;
use Illuminate\Http\Request;


class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hoteles = Hotel::with('destiny', 'services', 'rooms', 'rooms.type_room', 'rooms.reservations')->get();
        $vuelos = Fly::with('seats', 'airplane', 'destiny', 'flycosts', 'scales', 'flycosts.classe')->get();
        $usuarios = User::all();
        //dd($vuelos);
        return view('vistasLeo.Admin.reportes', compact('hoteles', 'vuelos', 'usuarios'));
    }
}

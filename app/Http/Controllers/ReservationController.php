<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
  public function index($id)
  {
    $room = Room::where('id_hotel', $id)->get();
    $reservations = Reservation::where('id_room', $room[0]->id)->with('user')->get();

    return view('vistasLeo.Admin.Hoteles.reservation.index', compact('reservations'));
  }
}

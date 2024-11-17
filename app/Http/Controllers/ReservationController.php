<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\UserReservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index($id)
    {
        $room = Room::where('id_hotel', $id)->get();
        $reservations = Reservation::where('id_room', $room[0]->id)->with('user')->get();

        return view('vistasLeo.Admin.Hoteles.reservation.index', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'cant_adults' => 'required',
            'cant_infants' => 'required',
            'cant_kinds' => 'required',
            'status_payment' => 'required',
            'id_room' => 'required',
            'name' => 'required',
            'last_names' => 'required',
            'birthdate' => 'required|date',
            'email' => 'required|email',
            'phone' => 'required',
            'id_gender' => 'required'
        ]);

        $userReservation = UserReservation::create([
            'name' => $request->name,
            'last_names' => $request->last_names,
            'birthdate' => $request->birthdate,
            'email' => $request->email,
            'phone' => $request->phone,
            'id_gender' => $request->id_gender
        ]);

        $reservation = Reservation::create([
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'cant_adults' => $request->cant_adults,
            'cant_infants' => $request->cant_infants,
            'cant_kinds' => $request->cant_kinds,
            'status_payment' => $request->status_payment,
            'id_room' => $request->id_room,
            'id_user_reservation' => $userReservation->id
        ]);

        $room = Room::find($request->id_room);
        $room->status = 1;
        $room->save();


        return redirect()->route('rutareservaciones')->with('message', 'Reservación realizada con éxito');
    }
}

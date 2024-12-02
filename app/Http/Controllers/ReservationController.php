<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User_Reservation;
use App\Models\Room;
use App\Models\User;
use App\Models\Buy;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;
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
            'status_payment' => 'required',
            'id_room' => 'required',
            'name' => 'required',
            'last_names' => 'required',
            'birthdate' => 'required|date',
            'email' => 'required|email',
            'phone' => 'required',
            'id_gender' => 'required'
        ]);

        $room = Room::with('type_room')->find($request->id_room);
        $peoples = $request->cant_adults + $request->cant_infants;

        if($request->check_in > $request->check_out){
            return redirect()->back()->with('message', 'La fecha de entrada no puede ser mayor a la fecha de salida');
        }if($request->check_in < date('Y-m-d')){
            return redirect()->back()->with('message', 'La fecha de entrada no puede ser menor a la fecha actual');
        }if($request->check_out < date('Y-m-d')){
            return redirect()->back()->with('message', 'La fecha de salida no puede ser menor a la fecha actual');
        }if($peoples > $room->type_room->max_people){
            return redirect()->back()->with('message', 'El número de personas supera la capacidad de la habitación');
        }

        $userReservation = User_Reservation::create([
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
            'status_payment' => $request->status_payment,
            'id_room' => $request->id_room,
            'id_user_reservation' => $userReservation->id
        ]);

        $reservationId = $reservation->id;

        $room = Room::find($request->id_room);
        $room->status = 1;
        $room->save();

        $id_user = Auth::id();
        $roomId = $room;

        Buy::create([
            'id_reservation'=>$reservationId,
            'id_user' => $id_user
        ]);


        return redirect()->route('rutareservaciones')->with('message', 'Reservación realizada con éxito');
    }
}

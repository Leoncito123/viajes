<?php

namespace App\Http\Controllers;

use App\Models\Destiny;
use App\Models\Fly;
use App\Models\Hotel;
use App\Models\Passenger;
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
        $vuelos = Fly::with('seats', 'airplane', 'destiny', 'flycosts', 'scales', 'flycosts.classe', 'airplane.airline', 'seats.passengers')->get();

        //dd($vuelos);
        return view('vistasLeo.Admin.reportes', compact('hoteles', 'vuelos'));
    }

    public function filtrar(Request $request)
    {
        $queryHoteles = Hotel::query();
        $queryVuelos = Fly::query();


        if ($request->filled('hotel_name')) {
            $queryHoteles->where('name', 'like', '%' . $request->hotel_name . '%');
        }
        if ($request->filled('hotel_description')) {
            $queryHoteles->where('description', 'like', '%' . $request->hotel_description . '%');
        }
        if ($request->filled('hotel_phone')) {
            $queryHoteles->where('phone', 'like', '%' . $request->hotel_phone . '%');
        }
        if ($request->filled('hotel_stars')) {
            $queryHoteles->where('stars', $request->hotel_stars);
        }
        if ($request->filled('hotel_distance')) {
            $queryHoteles->where('town_center_distance', $request->hotel_distance);
        }
        if ($request->filled('hotel_destination')) {
            $queryHoteles->whereHas('destiny', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->hotel_destination . '%');
            });
        }
        if ($request->filled('hotel_services')) {
            $queryHoteles->whereHas('services', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->hotel_services . '%');
            });
        }
        if ($request->filled('hotel_rooms')) {
            $queryHoteles->whereHas('rooms', function ($query) use ($request) {
                $query->havingRaw('COUNT(rooms.id) = ?', [$request->hotel_rooms]);
            });
        }

        // Filtros para vuelos
        if ($request->filled('airline')) {
            $queryVuelos->whereHas('airplane.airline', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->airline . '%');
            });
        }
        if ($request->filled('fly_number')) {
            $queryVuelos->where('fly_number', 'like', '%' . $request->fly_number . '%');
        }
        if ($request->filled('departure_date')) {
            $queryVuelos->where('depature_date', $request->departure_date);
        }
        if ($request->filled('arrival_date')) {
            $queryVuelos->where('arrival_date', $request->arrival_date);
        }
        if ($request->filled('duration')) {
            $queryVuelos->where('fly_duration', $request->duration);
        }
        if ($request->filled('airplane')) {
            $queryVuelos->whereHas('airplane', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->airplane . '%');
            });
        }
        if ($request->filled('destination')) {
            $queryVuelos->whereHas('destiny', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->destination . '%');
            });
        }
        if ($request->filled('seats')) {
            $queryVuelos->whereHas('seats', function ($query) use ($request) {
                $query->havingRaw('COUNT(seats.id) = ?', [$request->seats]);
            });
        }
        if ($request->filled('costs')) {
            $queryVuelos->whereHas('flycosts', function ($query) use ($request) {
                $query->where('cost', 'like', '%' . $request->costs . '%');
            });
        }
        if ($request->filled('scales')) {
            $queryVuelos->whereHas('scales.destiny', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->scales . '%');
            });
        }

        $hoteles = $queryHoteles->with('destiny', 'services', 'rooms', 'rooms.type_room', 'rooms.reservations')->get();
        $vuelos = $queryVuelos->with('seats', 'airplane', 'destiny', 'flycosts', 'scales.destiny', 'flycosts.classe', 'airplane.airline', 'seats.passengers')->get();

        return response()->json([
            'hoteles' => $hoteles,
            'vuelos' => $vuelos,
        ]);
    }
}

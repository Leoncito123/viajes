<?php

namespace App\Http\Controllers\leo;

use App\Http\Controllers\Controller;
use App\Models\Destiny;
use App\Models\Hotel;
use App\Models\Picture;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Http\Request;


class HotelesController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $hoteles = Hotel::with('destiny', 'pictures', 'rooms')->get();
    $servicios = Service::all();
    return view('vistasLeo.Admin.hoteles', compact('hoteles', 'servicios'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $services = Service::all();

    return view('vistasLeo.Admin.Hoteles.create', compact('services'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'name_hotel' => 'required',
      'phone' => 'required|numeric',
      'stars' => 'required|numeric',
      'town_center_distance' => 'required|numeric',
      'longitude' => 'required|numeric',
      'latitude' => 'required|numeric',
      'services' => 'required|array',
      'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'descriptions' => 'required|array',
      'descriptions.*' => 'required|string|max:255',
      'number_rooms' => 'required|numeric',
    ]);

    $destiny = Destiny::create([
      'name' => $request->name_hotel,
      'longitude' => $request->longitude,
      'latitude' => $request->latitude,
    ]);

    $hotel = Hotel::create([
      'name' => $request->name,
      'phone' => $request->phone,
      'stars' => $request->stars,
      'town_center_distance' => $request->town_center_distance,
      'id_destiny' => $destiny->id,
    ]);

    $hotel->services()->attach($request->services);
    for ($i = 0; $i < $request->number_rooms; $i++) {
      Room::create([
        'name' => 'Habitación ' . ($i + 1),
        'id_hotel' => $hotel->id,
      ]);
    }
    if ($request->hasFile('images')) {
      foreach ($request->file('images') as $index => $imageFile) {
        $path = $imageFile->store('hotels', 'public');

        Picture::create([
          'name' => $path,
          'description' => $request->descriptions[$index],
          'id_hotel' => $hotel->id
        ]);
      }
    }

    return redirect()->route('admin.hoteles')->with('success', 'Hotel creado correctamente');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit()
  {
    return view('vistasLeo.Admin.Hoteles.edit');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $hotel = Hotel::find($id);
    $hotel->pictures()->delete();
    $hotel->delete();

    return back()->with('success', 'Hotel eliminado correctamente');
  }

  public function politicas($id)
  {
    $politicas = Hotel::find($id)->politics;
    return view('vistasLeo.Admin.politicasCancelacion', compact('id', 'politicas'));
  }

  public function politicasStore(Request $request, $id)
  {
    $request->validate([
      'cancellation_policies' => 'required|string',
    ]);
    $hotel = Hotel::find($id);
    $hotel->politics = $request->cancellation_policies;
    $hotel->save();

    return redirect()->route('admin.hoteles')->with('success', 'Políticas de cancelación guardadas correctamente');
  }
}

<?php

namespace App\Http\Controllers\leo;

use App\Http\Controllers\Controller;
use App\Models\Destiny;
use App\Models\Hotel;
use App\Models\Picture;
use App\Models\Room;
use App\Models\Service;
use App\Models\Type_room;
use Illuminate\Support\Facades\Storage;
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
    $type_rooms = Type_room::all();
    return view('vistasLeo.Admin.hoteles', compact('hoteles', 'servicios', 'type_rooms'));
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
      'descriptions.*' => 'required|string',
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
  public function show()
  {
    $hoteles = Hotel::with('destiny', 'pictures', 'rooms')->get();

    return view('vistasLeo.Hoteles.index', compact('hoteles'));
  }

  public function showHotel($id)
  {
    $hotel = Hotel::with('destiny', 'pictures', 'services', 'rooms.type_room', 'opinions')->find($id);

    return view('vistasLeo.Hoteles.infohotel', compact('hotel'));
  }
  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    $hotel = Hotel::with('pictures', 'services', 'destiny', 'rooms')->find($id);
    $services = Service::all();
    return view('vistasLeo.Admin.Hoteles.edit', compact('hotel', 'services'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
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
      'new_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'new_descriptions.*' => 'nullable|string',
      'existing_descriptions.*' => 'nullable|string',
    ]);
    $hotel = Hotel::find($id);

    $hotel->update([
      'name' => $request->name,
      'phone' => $request->phone,
      'stars' => $request->stars,
      'town_center_distance' => $request->town_center_distance,
    ]);

    $hotel->destiny->update([
      'name' => $request->name_hotel,
      'longitude' => $request->longitude,
      'latitude' => $request->latitude,
    ]);

    $hotel->services()->sync($request->services);

    if ($request->has('existing_descriptions')) {
      foreach ($request->existing_descriptions as $pictureId => $description) {
        Picture::where('id', $pictureId)
          ->where('id_hotel', $hotel->id)
          ->update(['description' => $description]);
      }
    }
    if ($request->hasFile('new_images')) {
      foreach ($request->file('new_images') as $index => $imageFile) {
        if ($imageFile && isset($request->new_descriptions[$index])) {
          $path = $imageFile->store('hotels', 'public');
          Picture::create([
            'name' => $path,
            'description' => $request->new_descriptions[$index],
            'id_hotel' => $hotel->id
          ]);
        }
      }
    }
    return redirect()->route('admin.hoteles')->with('success', 'Hotel actualizado correctamente');
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

  public function deleteImage($id)
  {
    $picture = Picture::find($id);
    Storage::disk('public')->delete($picture->name);
    $picture->delete();
    return back()->with('success', 'Imagen eliminada correctamente');
  }
}

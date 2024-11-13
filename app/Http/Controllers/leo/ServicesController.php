<?php

namespace App\Http\Controllers\leo;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
  public function create(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'description' => 'required',
    ]);

    $service = Service::create([
      'name' => $request->name,
      'description' => $request->description,
    ]);

    return redirect()->route('admin.hoteles')->with('success', 'Servicio creado correctamente');
  }

  public function delete($id)
  {
    $service = Service::find($id);
    $service->delete();

    return redirect()->route('admin.hoteles')->with('success', 'Servicio eliminado correctamente');
  }
}

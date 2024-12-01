<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type_room;

class Type_RoomsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  /**
   * Show the form for creating a new resource.
   */
  public function create() {}

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'description' => 'required',
      'price' => 'required',
      'max_people' => 'required',
    ]);

    $type_room = Type_room::create($request->all());

    return redirect()->route('admin.hoteles')->with('success', 'Tipo de habitación creado correctamente');
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
  public function edit(string $id) {}

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'name' => 'required',
      'description' => 'required',
      'price' => 'required',
      'max_people' => 'required',
    ]);

    $type_room = Type_room::find($id);
    $type_room->update($request->all());

    return redirect()->route('admin.hoteles')->with('success', 'Tipo de habitación actualizado correctamente');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $type_room = Type_room::find($id);
    $type_room->delete();

    return redirect()->route('admin.hoteles')->with('success', 'Tipo de habitación eliminado correctamente');
  }
}

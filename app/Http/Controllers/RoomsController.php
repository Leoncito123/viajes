<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Type_room;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index($id)
  {
    $rooms = Room::where('id_hotel', $id)->with('type_room', 'hotel')->get();

    $types = Type_room::all();
    return view('vistasLeo.Admin.Hoteles.rooms.index', compact('rooms', 'types'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
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
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'roomId' => 'required',
      'typeId' => 'required',
    ]);

    $room = Room::find($request->roomId);
    $room->update([
      'id_type_rooms' => $request->typeId,
    ]);

    return redirect()->back()->with('success', 'Room updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}

<?php

namespace App\Http\Controllers\leo;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;


class HotelesController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('vistasLeo.Admin.hoteles');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'check-in' => 'required|date',
      'check-out' => 'required|name',
      'rooms' => 'required|numeric',
      'category' => 'required|numeric',
      'price' => 'required|numeric',
      'distance' => 'required|numeric',
      'services' => 'required',
      'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      'description' => 'required',
    ]);
    return back()->with('success', 'Hotel creado correctamente');
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
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}

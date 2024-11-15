<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;
use OCILob;

class ComentsController extends Controller
{
  public function index($id)
  {
    $coments = Opinion::where('id_hotel', $id)->with('user', 'hotel')->get();

    return view('vistasLeo.Admin.Hoteles.coments.index', compact('coments'));
  }
}

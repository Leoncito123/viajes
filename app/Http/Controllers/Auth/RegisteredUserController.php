<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   */
  public function create(): View
  {
    return view('auth.register');
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'last_name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
      'phone' => ['required', 'string', 'max:255'],
      'birthdate' => ['required', 'date', 'max:255'],
      'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $photo = $request->file('photo');

    if ($photo) {
      $path = $photo->store('image_profile', 'public');
    }


    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'last_name' => $request->last_name,
      'phone' => $request->phone,
      'birthdate' => $request->birthdate,
      'password' => Hash::make($request->password),
      'profile_photo_path' => $path,
    ]);

    $user->assignRole('user');

    session()->flash('exito', 'Registro exitoso');

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('verification.notice'));
  }
}

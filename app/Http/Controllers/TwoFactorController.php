<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\View\View;

class TwoFactorController extends Controller
{
    
    /**
     * Show the 2FA verification form.
     */
    public function show(): View
    {
        return view('auth.2fa');
    }

    /**
     * Verify the 2FA code.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            '2fa_code' => ['required', 'numeric'],
        ]);

        $google2fa = app(Google2FA::class);
        $user = Auth::user();

        $valid = $google2fa->verifyKey($user->two_factor_secret, $request->input('2fa_code'));

        if ($valid) {
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['2fa_code' => 'El código de autenticación de dos factores no es válido.']);
    }
}

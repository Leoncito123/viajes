<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->hasFile('profile_photo_path')) {
            if ($request->user()->profile_photo_path) {
                Storage::disk('public')->delete($request->user()->profile_photo_path);
            }

            $image = $request->file('profile_photo_path')->store('image_profile', 'public');
            $request->user()->profile_photo_path = $image;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    private function custom_generate_qrcode_url($qrCodeUrl): string
    {
        return 'data:image/png;base64,' . base64_encode(
            QrCode::format('png')->size(400)->errorCorrection('H')->generate($qrCodeUrl)
        );
    }


    public function autenticationgoogle(): RedirectResponse
    {
        $user = Auth::user();

        $google2fa = app(Google2FA::class);

        if (!$user->two_factor_secret) {
            $user->two_factor_secret = $google2fa->generateSecretKey();
            $user->save();
        }

        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $user->two_factor_secret
        );
        
        $qrcode_image = $this->custom_generate_qrcode_url($qrCodeUrl);

        return redirect()->back()->with('google2fa_url', $qrcode_image);
    }

}

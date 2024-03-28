<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user'   => $request->user(),
            'title'  => 'Profil',
            'active' => 'Profil',
        ]);
    }

    /**
     * Update the user's profile information.
     */
   public function update(ProfileUpdateRequest $request): RedirectResponse
{
    // Mengisi model user dengan data yang divalidasi dari permintaan
    $request->user()->fill($request->validated());

    // Memeriksa apakah email telah diubah
    if ($request->user()->isDirty('email')) {
        // Jika ya, null-kan atribut email_verified_at untuk memerlukan verifikasi ulang
        $request->user()->email_verified_at = null;
    }

    // Menyimpan perubahan pada model user
    $request->user()->save();

    // Mengarahkan kembali pengguna ke rute 'profile.edit' dengan pesan status 'profile-updated'
    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

    /**
     * Delete the user's account.
     */
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
}

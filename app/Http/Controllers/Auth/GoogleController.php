<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to Google's OAuth page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }

        // Find or create user
        $user = User::where('google_id', $googleUser->id)
            ->orWhere('email', $googleUser->email)
            ->first();

        if ($user) {
            // Update Google ID if user exists but doesn't have one
            if (empty($user->google_id)) {
                $user->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                ]);
            }
        } else {
            // Create new user
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'role' => 'user',
                'email_verified_at' => now(), // Auto-verify for Google users
            ]);
        }

        // Login the user
        Auth::login($user, true);

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Berhasil login dengan Google!');
        }

        return redirect()->intended('/')
            ->with('success', 'Berhasil login dengan Google!');
    }
}

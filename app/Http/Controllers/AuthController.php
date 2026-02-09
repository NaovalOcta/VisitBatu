<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Notifications\OtpNotification;

class AuthController extends Controller
{
    // --- LOGIN ---
    public function showLoginForm()
    {
        return view('auth.auth_page', ['isSignUp' => false]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check if credentials are valid (but don't login yet)
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Email atau password yang Anda masukkan salah.',
            ])->onlyInput('email');
        }

        // Generate OTP and send email
        $otp = $user->generateOtp();
        $user->notify(new OtpNotification($otp));

        // Store email in session for OTP verification
        session(['otp_email' => $user->email]);

        return redirect()->route('otp.show')
            ->with('success', 'Kode OTP telah dikirim ke email Anda.');
    }

    // --- OTP VERIFICATION ---
    public function showOtpForm()
    {
        if (!session('otp_email')) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('auth.verify-otp', [
            'email' => session('otp_email'),
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $email = session('otp_email');

        if (!$email) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Silakan login ulang.');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'User tidak ditemukan.');
        }

        if (!$user->verifyOtp($request->otp)) {
            return back()->withErrors([
                'otp' => 'Kode OTP tidak valid atau sudah kadaluarsa.',
            ]);
        }

        // Clear session
        session()->forget('otp_email');

        // Login the user
        Auth::login($user, true);

        // Mark email as verified if not already
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Berhasil login!');
        }

        return redirect()->intended('/')
            ->with('success', 'Berhasil login!');
    }

    public function resendOtp()
    {
        $email = session('otp_email');

        if (!$email) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Silakan login ulang.');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'User tidak ditemukan.');
        }

        // Generate new OTP and send
        $otp = $user->generateOtp();
        $user->notify(new OtpNotification($otp));

        return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
    }

    // --- REGISTER ---
    public function showRegisterForm()
    {
        return view('auth.auth_page', ['isSignUp' => true]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Generate OTP and send for verification
        $otp = $user->generateOtp();
        $user->notify(new OtpNotification($otp));

        // Store email in session for OTP verification
        session(['otp_email' => $user->email]);

        return redirect()->route('otp.show')
            ->with('success', 'Registrasi berhasil! Silakan masukkan kode OTP yang dikirim ke email Anda.');
    }

    // --- EMAIL VERIFICATION (Legacy - kept for compatibility) ---
    public function verificationNotice(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/');
        }

        return view('auth.verify-email');
    }

    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Link verifikasi tidak valid.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/')->with('success', 'Email sudah terverifikasi sebelumnya.');
        }

        $user->markEmailAsVerified();

        return redirect('/')->with('success', 'Email berhasil diverifikasi! Selamat datang di VisitBatu.');
    }

    public function resendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Link verifikasi baru telah dikirim ke email Anda.');
    }

    // --- LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

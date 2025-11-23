<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Notifications\LoginOtpNotification;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Attempt auth (credentials) – user becomes authenticated momentarily
        $request->authenticate();
        $user = Auth::user();
        if (!$user) {
            return back()->withErrors(['email' => 'Autentikasi gagal.']);
        }
        // Generate OTP for login (5 minute expiry, attempts start at 0)
        $code = str_pad((string) random_int(0,999999),6,'0',STR_PAD_LEFT);
        $payload = [
            'hash' => hash('sha256',$code),
            'expires' => now()->addMinutes(5),
            'attempts' => 0,
            'max_attempts' => 5,
        ];
        Cache::put('login-otp-user-'.$user->id, $payload, now()->addMinutes(5));
        $request->session()->put('otp_pending_user', $user->id);
        $request->session()->put('otp_verified', false);
        $request->session()->save();
        $status = 'login-otp-sent';
        try {
            $user->notify(new \App\Notifications\LoginOtpNotification($code));
        } catch (\Throwable $e) {
            Log::warning('Login OTP send failed: '.$e->getMessage());
            $status = 'login-otp-send-failed';
        }
        return redirect()->route('otp.form')->with('status',$status);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\LoginOtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class OtpLoginController extends Controller
{
    protected function cacheKey(int $userId): string
    {
        return 'login-otp-user-'.$userId;
    }

    protected function resendKey(int $userId): string
    {
        return 'login-otp-resend-'.$userId;
    }

    public function show(Request $request)
    {
        $isRegistration = $request->session()->has('registration_pending_user');
        $isLogin = $request->session()->has('otp_pending_user');
        if (!$isRegistration && !$isLogin) {
            Log::info('OTP form accessed without pending session');
            return redirect()->route('login')->with('status','otp-missing');
        }
        Log::info('Showing OTP form', [
            'context' => $isRegistration ? 'registration' : 'login',
            'reg_pending' => $isRegistration,
            'login_pending' => $isLogin,
        ]);
        return view('auth.otp', [
            'status' => session('status'),
            'context' => $isRegistration ? 'registration' : 'login',
        ]);
    }

    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required','digits:6']
        ]);

        $isRegistration = $request->session()->has('registration_pending_user');
        $userId = $isRegistration ? $request->session()->get('registration_pending_user') : $request->session()->get('otp_pending_user');
        if (!$userId) {
            return redirect()->route('login')->with('status','otp-missing');
        }
        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('login')->with('status','otp-user-missing');
        }

        $key = $isRegistration ? 'register-otp-user-'.$userId : 'login-otp-user-'.$userId;
        $data = Cache::get($key);
        if (!$data) {
            return back()->with('status','otp-expired');
        }
        if (now()->gt($data['expires'])) {
            Cache::forget($key);
            return back()->with('status','otp-expired');
        }
        $hash = hash('sha256', $request->string('code'));
        if (!hash_equals($data['hash'], $hash)) {
            $data['attempts'] = ($data['attempts'] ?? 0) + 1;
            if (($data['attempts'] ?? 0) >= ($data['max_attempts'] ?? 5)) {
                Cache::forget($key);
                return back()->with('status','otp-attempts-exceeded');
            }
            Cache::put($key, $data, $data['expires']);
            return back()->with('status','otp-invalid');
        }
        // Success
        Cache::forget($key);
        if ($isRegistration) {
            $request->session()->put('registration_otp_verified', true);
            $request->session()->forget('registration_pending_user');
            if (is_null($user->email_verified_at)) {
                $user->email_verified_at = now();
                $user->save();
            }
            return redirect()->route('login')->with('status','registration-otp-success');
        } else {
            $request->session()->put('otp_verified', true);
            $request->session()->forget('otp_pending_user');
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard', absolute: false));
        }
    }

    public function resend(Request $request): RedirectResponse
    {
        $isRegistration = $request->session()->has('registration_pending_user');
        $userId = $isRegistration ? $request->session()->get('registration_pending_user') : $request->session()->get('otp_pending_user');
        if (!$userId) {
            return redirect()->route('login');
        }
        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('login');
        }
        // Throttle resend every 60s
        $resendKey = $this->resendKey($userId);
        if (Cache::has($resendKey)) {
            return back()->with('status','otp-resend-throttled');
        }
        $code = str_pad((string) random_int(0,999999),6,'0',STR_PAD_LEFT);
        $payload = [
            'hash' => hash('sha256',$code),
            'expires' => now()->addMinutes(5),
            'attempts' => 0,
            'max_attempts' => 5,
        ];
        $key = $isRegistration ? 'register-otp-user-'.$userId : 'login-otp-user-'.$userId;
        Cache::put($key, $payload, now()->addMinutes(5));
        Cache::put($resendKey, true, 60); // throttle window
        try {
            $user->notify(new LoginOtpNotification($code));
            $status = $isRegistration ? 'reg-otp-resent' : 'login-otp-resent';
        } catch (\Throwable $e) {
            Log::warning('OTP resend failed: '.$e->getMessage());
            $status = $isRegistration ? 'reg-otp-send-failed' : 'login-otp-send-failed';
        }
        return back()->with('status', $status);
    }
}

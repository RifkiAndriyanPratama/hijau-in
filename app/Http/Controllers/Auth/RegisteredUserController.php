<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\Notifications\LoginOtpNotification;

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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Ambil ID role 'Masyarakat' secara dinamis (buat jika belum ada)
        $masyarakatRoleId = Role::firstOrCreate(['nama_role' => 'Masyarakat'])->id;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $masyarakatRoleId,
        ]);

        // Tidak kirim email verifikasi link – aktivasi hanya via OTP.

        // Generate OTP aktivasi (sebelum login). User belum login sekarang.
        $code = str_pad((string) random_int(0,999999),6,'0',STR_PAD_LEFT);
        $payload = [
            'hash' => hash('sha256',$code),
            'expires' => now()->addMinutes(5),
        ];
        Cache::put('register-otp-user-'.$user->id, $payload, now()->addMinutes(5));
        $request->session()->put('registration_pending_user', $user->id);
        $request->session()->put('registration_otp_verified', false);
        $status = 'reg-otp-sent';
        try {
            $user->notify(new LoginOtpNotification($code));
        } catch (\Throwable $e) {
            report($e);
            $status = 'reg-otp-send-failed';
        }
        return redirect()->route('otp.form')->with('status',$status);
    }
}

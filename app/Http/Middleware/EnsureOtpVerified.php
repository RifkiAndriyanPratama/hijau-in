<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureOtpVerified
{
    public function handle(Request $request, Closure $next)
    {
        // If user not fully OTP verified, redirect to OTP form.
        if ($request->user() && !$request->session()->get('otp_verified')) {
            // Allow access only to OTP related routes
            if (!$request->routeIs(['otp.form','otp.verify','otp.resend','logout'])) {
                return redirect()->route('otp.form');
            }
        }
        return $next($request);
    }
}

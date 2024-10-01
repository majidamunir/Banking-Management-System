<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('Auth.forgotPassword');
    }

    // Handle OTP sending
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
        $otp = rand(100000, 999999);

        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        Mail::to($user->email)->send(new OtpMail($otp));

        return redirect()->route('verifyOtpForm');
    }

    public function showVerifyOtpForm()
    {
        return view('Auth.verifyOtp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|integer'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->otp === $request->otp && now()->lessThanOrEqualTo($user->otp_expires_at)) {
            return redirect()->route('resetPasswordForm');
        }

        return back()->withErrors(['otp' => 'Invalid or Expired OTP.']);
    }

    public function showResetPasswordForm()
    {
        return view('Auth.resetPassword');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|integer',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->otp === $request->otp && now()->lessThanOrEqualTo($user->otp_expires_at)) {
            $user->password = bcrypt($request->password);
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            return redirect()->route('login')->with('status', 'Password Reset Successful!');
        }

        return back()->withErrors(['otp' => 'Invalid or Expired OTP.']);
    }
}

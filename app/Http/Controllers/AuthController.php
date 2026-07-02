<?php

namespace App\Http\Controllers;

use App\Mail\SendOTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        // dd(Auth::user());

        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/add-user');
        }

        return back()
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])
            ->onlyInput('email');
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        User::create([
            'name' => $request->input('nama-panjang'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);
        $data_otp = [
            'subject' => 'verify otp',
            'otp' => 123456,
        ];
        $send_email_otp = Mail::to($request->input('email'))->send(new SendOTP($data_otp));

        return redirect()->route('login')->with('success', 'Account created successfully. Please check email for otp.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function confirm_otp()
    {
        return view('confirm_otp');
    }

    public function verify_otp(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'otp' => ['required', 'array', 'size:6'],
            'otp.*' => ['required', 'numeric', 'digits:1'],
            'email' => ['required', 'email']
        ]);
        if ($validator->fails()) {
            dd($validator->messages()->all());
        }
        if ($request->otp[0] == 1 &&
            $request->otp[1] == 2 &&
            $request->otp[2] == 3 &&
            $request->otp[3] == 4 &&
            $request->otp[4] == 5 &&
            $request->otp[5] == 6) {

            $user = User::where('email', $request->email)->first();
            if (!$user){
                dd('User not found');
            }

            $user->email_verified_at = now();
            $user->is_active = true;
            $user->save();

            return redirect()->route('login')->with('success', 'Email verified successfully. You can now login.');
        }

        dd('OTP verification failed');
    }
}

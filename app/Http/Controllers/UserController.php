<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    public function resource()
    {
        return view('resource');
    }

    public function dashboard()
    {
        return view('Admin.index');
    }

    public function loan()
    {
        return view('Admin.loans');
    }

    public function rate()
    {
        return view('Admin.rates');
    }

    public function table() {
        return view('Admin.tables');
    }

    public function upgrade()
    {
        return view('Admin.upgrade');
    }

    public function showRegisterForm()
    {
        return view('Auth.register');
    }

//    public function register(Request $request)
//    {
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:8|confirmed',
//        ]);
//
//        User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//            'role' => 'customer',
//        ]);
//
//        return redirect()->route('login')->with('success', 'Registration Successful!!');
//    }
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
            'role' => 'customer',
        ]);

        event(new UserRegistered($user));

        return redirect()->route('login')->with('success', 'Registration Successful!!');
    }

    public function showLoginForm()
    {
        return view('Auth.login');
    }

//    public function login(Request $request)
//    {
//        $request->validate([
//            'email' => 'required|string|email',
//            'password' => 'required|string',
//        ]);
//
//        $credentials = $request->only('email', 'password');
//
//        if (Auth::attempt($credentials)) {
//            return redirect()->intended('dashboard');
//        }
//
//        return redirect()->back()->with('error', 'Invalid Credentials!!');
//    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('Dashboard');
            } else {
                return redirect()->route('Home');
            }
        }
        return redirect()->back()->with('error', 'Invalid Credentials!!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('Home');
    }
}


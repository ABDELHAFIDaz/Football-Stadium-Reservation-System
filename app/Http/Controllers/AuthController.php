<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function register(Request $request)
    {

        $validData = $request->validate([
            'fullname' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users',
            'phone_number' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|max:50|confirmed'
        ]);

        try {

            $service = new AuthService();
            $service->register($validData);

            return redirect()->route('home');
        } catch (\Exception) {
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|max:255'
        ]);


        $service = new AuthService();

        if (!$service->login($credentials)) {
            return back()->withErrors(['email' => 'Invalide email or password'])->withInput();
        }

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin');
        } else {
            return redirect()->route('home');
        }
    }


    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('home');
    }
}

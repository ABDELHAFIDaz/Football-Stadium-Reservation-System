<?php

namespace App\Http\Controllers;

use App\Services\AuthServerice;
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

        $validDate = $request->validate([
            'fullname' => 'required|string|max:100',
            'email' => 'required|string|email',
            'phone_number' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|max:50|confirmed'
        ]);

        $service = new AuthServerice();
        $service->register($request);

        return redirect('/');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|max:255'
        ]);


        $service = new AuthServerice();
        $service->login($credentials);

        $user = Auth::user();
        dd($user);

        if ($user->role === 'admin') {
            return redirect('/admin');
        } elseif ($user->role === 'client') {
            return redirect('/');
        } else {
            return redirect('/loginPage');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(private AuthService $authService) {}


    public function loginPage()
    {
        return view('auth.login');
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function register(RegisterRequest $request)
    {

        try {

            $this->authService->register($request->validated());

            return redirect()->route('home');
        } catch (\Exception) {
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function login(LoginRequest $request)
    {

        return match ($this->authService->login($request->validated())) {
            'invalid' => back()->withErrors(['email' => 'Invalid email or password'])->withInput(),
            'banned'  => redirect()->route('login.page')->with('error', 'Your account has been banned. Please contact the Admin.'),
            'admin'   => redirect()->route('admin.dashboard'),
            'manager' => redirect()->route('manager.dashboard'),
            default   => redirect()->route('home'),
        };
    }


    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('home');
    }
}

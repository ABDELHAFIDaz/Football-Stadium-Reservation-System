<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
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

    public function register(Request $request)
    {

        $validData = $request->validate([
            'fullname' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users',
            'phone_number' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|max:50|confirmed'
        ]);

        try {

            $this->authService->register($validData);

            return redirect()->route('home');
        } catch (\Exception) {
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|max:255',
        ]);

        return match ($this->authService->login($credentials)) {
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

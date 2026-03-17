<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use function Pest\Laravel\session;

class AuthService
{

    public function register($data)
    {

        $newUser = User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
            'role' => 'customer',
            // 'is_adult' => 1
        ]);

        // to login the new user automatically, without needing tyhe user to login after the sign up
        if ($newUser) {
            Auth::login($newUser);
        }
        
    }

    public function login($credentials)
    {
        if (Auth::attempt($credentials)) {

            session()->regenerate();
            return true;        
        }

        return false;
    }
}

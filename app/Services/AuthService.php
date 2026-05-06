<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
        ]);

        if ($newUser) {
            Auth::login($newUser);
        }
        
    }

    public function login($credentials)
    {
        if (!Auth::attempt($credentials)) 
            return 'invalid';
        
        session()->regenerate();

        if(Auth::user()->is_banned){
            Auth::logout();
            return 'banned';
        }

        return Auth::user()->role;
    }
}

<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use function Pest\Laravel\session;

class AuthServerice{

    public function register($data)
    {

        $newUser = User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['name']),
            'role' => 'client'
        ]);

        if($newUser){
            Auth::login($newUser);
        }

    }

    public function login($credentials)
    {
        if(Auth::attempt($credentials)){
            
            session()->regenerate();
            // Auth::login(User::where('email', $credentials['email'])->get());
            Auth::user();
        }
    }
}
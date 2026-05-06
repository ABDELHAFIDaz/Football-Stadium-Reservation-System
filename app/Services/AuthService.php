<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class AuthService
{

    public function __construct(private UserRepositoryInterface $userRepository){}

    public function register($data)
    {

        $newUser = $this->userRepository->create($data, 'customer');

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

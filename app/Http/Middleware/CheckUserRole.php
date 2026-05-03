<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (Auth::user()->is_banned) {
            Auth::logout();
            return redirect()->route('login.page')->with('error', 'Your account has been banned. Please contact the Admin.');
        }

        if (in_array('guest', $roles) && Auth::guest()) // just for login and the sign up pages
            return $next($request);
        else if (in_array('guest', $roles))
            return back();



        if (Auth::guest())
            return redirect()->route('login.page');




        $userRole = Auth::user()->role;

        if (! in_array($userRole, $roles))
            abort(403, 'Unauthorized action.');


        return $next($request);
    }
}

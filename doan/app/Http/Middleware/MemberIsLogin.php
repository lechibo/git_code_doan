<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MemberIsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if (Auth::check()) {

            if (Auth::user()->level == 1) {
                return redirect()->route('home');
            }

            return redirect()->route('appfe');
        }

        return $next($request);// chưa login thì hiển thị login
    }
}

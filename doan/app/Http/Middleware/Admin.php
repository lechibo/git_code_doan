<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if(Auth::check() && Auth::user()->level == 1){
        //     return $next($request); 
        // }else{
        //     Auth::logout();
        //     return redirect('/login');
        // }

        
        // dd('Middleware Admin đã chạy');
        //dd(Auth::user()->level);
    if (Auth::check()) {
        // dd([
        //     'url' => $request->url(),
        //     'level' => Auth::user()->level ?? null,
        // ]);
        if (Auth::user()->level == 1) {
            return $next($request);
        }

        return redirect()->route('appfe');
    }

    return redirect()->route('login');
    }
    
}


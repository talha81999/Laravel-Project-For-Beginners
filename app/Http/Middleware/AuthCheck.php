<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session('data'))
        {
            $response =  redirect('login')->with('fail','Please Login First!');
            $response->header('Cache-Control', 'no-store');
            return $response;
        }
        else{
            $response = $next($request);
            $response->header('Cache-Control', 'no-store');
            return $response;
        }

    }
}

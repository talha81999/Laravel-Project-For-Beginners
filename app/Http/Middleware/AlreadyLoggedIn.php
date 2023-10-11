<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLoggedIn
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
        if(session()->has('data') && session('data')['userType'] == 0 && ( $request->url() == url('login')  ) ){
            $response =  redirect('admin-dashboard');
            $response->header('Cache-Control', 'no-store');
            return $response;
        }
        elseif (session()->has('data') && session('data')['userType'] == 2 && ( $request->url() == url('login')  )) {
            $response =  redirect('user-dashboard');
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

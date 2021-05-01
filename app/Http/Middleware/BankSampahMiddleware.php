<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BankSampahMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role != "bank_sampah"){
            return redirect()->to('home');
        }
        return $next($request);
    }
}

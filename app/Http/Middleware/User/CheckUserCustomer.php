<?php

namespace App\Http\Middleware\User;

use Closure;

class CheckUserCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role !== 1) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}

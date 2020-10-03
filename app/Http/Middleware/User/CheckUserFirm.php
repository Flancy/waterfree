<?php

namespace App\Http\Middleware\User;

use Closure;

class CheckUserFirm
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
        if (auth()->user()->role !== 2) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}

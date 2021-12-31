<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
		if(auth()->user() && auth()->user()->role == 'admin'|| auth()->user()->role == 'editor')
        { 
            return $next($request);
        }
		return abort(404);
    }
}

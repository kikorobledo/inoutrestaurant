<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsEstablishmentUpdatedMiddleware
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
        if(auth()->user()->establishment->name == null ||
            auth()->user()->establishment->email == null ||
            auth()->user()->establishment->name == null ||
            auth()->user()->establishment->address == null ||
            auth()->user()->establishment->telephone == null
            )
        {
            return redirect()->route('admin.profile')->with('message', 'Actualiza los datos de tu establecimiento para poder comenzar a user el sistema InOut.');;
        }

        return $next($request);
    }
}

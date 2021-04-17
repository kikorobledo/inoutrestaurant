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

        if(auth()->user()->establishment == null){
            $user = auth()->user()->createdBy;
        }else{
            $user = auth()->user();
        }

        if($user->establishment->name == null ||
            $user->establishment->email == null ||
            $user->establishment->name == null ||
            $user->establishment->address == null ||
            $user->establishment->telephone == null
            )
        {
            return redirect()->route('admin.profile')->with('message', 'Actualiza los datos de tu establecimiento para poder comenzar a user el sistema InOut.');;
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if ( auth()->user()->hasAnyRole(['super-admin', 'admin']) ) {
            return redirect('home');
        }
        else{
            return redirect('post');
        }

        return $next($request);
    }
}

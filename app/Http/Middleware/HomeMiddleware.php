<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class HomeMiddleware
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

        $user_type = Auth::user()->id_type;

        if ($user_type != 2) {
            return redirect('Dashboard');
        }            

        return $next($request);
    }
}

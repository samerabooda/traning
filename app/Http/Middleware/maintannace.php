<?php

namespace App\Http\Middleware;

use Closure;

class maintannace
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

        if (setting()->maintenance == '0'){
            return redirect()->route('maintance');
        }else{
            return $next($request);
        }

    }
}

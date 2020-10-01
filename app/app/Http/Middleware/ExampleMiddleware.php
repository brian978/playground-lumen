<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ExampleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        echo 'Passing through the example middleware';

        return $next($request);
    }
}

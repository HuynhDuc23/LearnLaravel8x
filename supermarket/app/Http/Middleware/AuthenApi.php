<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenApi
{
    public function handle(Request $request, Closure $next)
    {
        echo 'Middleware is Request';
        return $next($request);
    }
}

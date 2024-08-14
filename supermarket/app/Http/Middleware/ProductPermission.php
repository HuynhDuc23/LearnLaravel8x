<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProductPermission
{

    public function handle(Request $request, Closure $next)
    {
        echo 'request product admin permission';
        return $next($request);
    }
}

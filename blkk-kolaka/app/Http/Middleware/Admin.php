<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    private $Auth;
    public function handle(Request $request, Closure $next)
    {
        $this->auth = auth()->user() ? auth()->user()->role === 'admin' : false;

        if ($this->auth === true) {
            return $next($request);
        }
        return back();
    }
}

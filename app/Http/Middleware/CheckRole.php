<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if ($request->user()->roles == $role) {
            return $next($request);
        }

        abort(403, 'Anda bukan '.$role);
    }
}

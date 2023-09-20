<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class InRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param array $roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            if ( Str::slug($request->user()->inRole($role) )) {
                return $next($request);
            }
        }
        return response('Forbidden.', 403);
    }
}

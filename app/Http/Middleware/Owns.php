<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Owns
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if (Auth::id() !== $request->route($type)->user_id) {
            return abort(404);
        }

        return $next($request);
    }
}

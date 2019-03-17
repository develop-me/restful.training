<?php

namespace App\Http\Middleware;

use Closure;

class Account
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
        if ($request->route("account")->id !== $request->route($type)->account_id) {
            return abort(404);
        }

        return $next($request);
    }
}

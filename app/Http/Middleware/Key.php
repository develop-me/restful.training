<?php

namespace App\Http\Middleware;

use Closure;

class Key
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
        if ($request->get("key") === $request->route("account")->key) {
            return $next($request);
        }

        return response([
            "reason" => "Invalid API key",
        ], 401);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Rejects requests which don't come from the API
 */
class IpFilter
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
        if($request->ip() == env('ADRESSE_API', '127.0.0.1'))
            return $next($request);

        return response('Only the API can access this route.', 401);
    }
}

<?php

namespace LiveCMS\Middleware;

use Closure;

class HttpsMiddleware
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
        $request->setTrustedProxies([
            $request->getClientIp(),
        ]);

        if (!$request->secure() && app()->environment('production')) {
                return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}

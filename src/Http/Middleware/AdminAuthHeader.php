<?php declare(strict_types=1);

namespace Iosum\AdminAuth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuthHeader
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->bearerToken()) {
            if ($request->hasCookie(config('passport.admin.cookie.name'))) {
                $token = $request->cookie(config('passport.admin.cookie.name'));
                $request->headers->add(['Authorization' => 'Bearer ' . $token]);
            }
        }

        return $next($request);
    }
}

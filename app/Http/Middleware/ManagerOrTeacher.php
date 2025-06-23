<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerOrTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guards = ['teacher', 'manager'];

        foreach ($guards as $guard) {
            if (auth($guard)->check()) {
                // سجلي دخولك تحت هذا الجارد
                auth()->shouldUse($guard);
                return $next($request);
            }
        }

        return redirect()->route('login'); // أو abort(403)
    }
}

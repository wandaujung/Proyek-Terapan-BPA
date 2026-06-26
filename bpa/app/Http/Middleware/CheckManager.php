<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckManager
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!$user || !$user->division || strtolower($user->division->name) !== 'manager') {
            if ($user && $user->division) {
                return redirect('/dashboard/' . strtolower($user->division->name));
            }
            return redirect('/login')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}

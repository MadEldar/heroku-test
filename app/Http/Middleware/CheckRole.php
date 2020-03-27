<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        if (Auth::check()) {
            $userRole = Auth::user()->role;
            if ($userRole == User::adminRole) {
                return $next($request);
            } else if ($request->is('admin/*')) {
                return redirect()->back()->withErrors(['User is unauthorized.']);
            } else {
                return $next($request);
            }
        } else {
            return redirect('/sign-in')->withErrors(['User must login first.']);
        }
    }
}

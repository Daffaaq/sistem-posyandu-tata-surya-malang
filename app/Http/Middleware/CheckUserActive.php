<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // dd($request->user()->is_active);
        if ($request->user()->is_active === 'non-active') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            // Redirect to a specific route or show a message if the account is not active
            return redirect()->route('account.inactive')->with('error', 'Your account is inactive. Please contact an administrator.');
        }

        return $next($request);
    }
}

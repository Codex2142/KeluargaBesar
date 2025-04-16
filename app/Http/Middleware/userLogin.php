<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class userLogin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        $user = Auth::user()    ;

        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!in_array($user->level, $levels)) {
            // dd($levels);
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}

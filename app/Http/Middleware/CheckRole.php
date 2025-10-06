<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    /* public function handle(Request $request, Closure $next)
    {
        $roles = array_slice(func_get_args(), 2);

        foreach ($roles as $role) { 
            $user = \Auth::user()->role;
            if( $user == $role){
                return $next($request);
            }
        }

        return redirect('/');
        // return $next($request);
    } */

        public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah user masih login
        if (!Auth::check()) {
            return redirect('/'); // kalau session habis, balik ke index/login
        }

        // Ambil role user
        $userRole = Auth::user()->role;

        // Cek apakah role user ada di daftar role yang diizinkan
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Kalau role tidak cocok → redirect
        return redirect('/');
    }

}

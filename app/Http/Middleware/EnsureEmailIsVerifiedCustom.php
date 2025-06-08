<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureEmailIsVerifiedCustom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // untuk membuat pesan 403 bagi user yang belum verivikasi email
         if (! $request->user() || ! $request->user()->hasVerifiedEmail()) {
            abort(403, 'Anda belum verifikasi.');
        }

        return $next($request);
    }
}

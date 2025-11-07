<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek: Apakah user sudah login? DAN Apakah dia admin?
        if (auth()->check() && auth()->user()->is_admin) {
            // Jika YA, biarkan dia lanjut (return $next($request))
            return $next($request);
        }

        // Jika TIDAK, tendang dia kembali ke dashboard user biasa
        return redirect(route('dashboard'));
    }
};


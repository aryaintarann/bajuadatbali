<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Hanya admin (id == 1) yang boleh akses dashboard
        if ($user->id !== 1) {
            return redirect()->route('home')
                ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Lanjutkan ke controller (DashboardController::index)
        return $next($request);
    }
}

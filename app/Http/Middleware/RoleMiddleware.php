<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Перевірка автентифікації користувача
        if (!Auth::check()) {
            return redirect('login');
        }

        // Перевірка ролі користувача
        $user = Auth::user();
        if ($user->role !== $role) {
            return redirect('/'); // або ви можете викинути 403 помилку: abort(403);
        }

        return $next($request);
    }
}

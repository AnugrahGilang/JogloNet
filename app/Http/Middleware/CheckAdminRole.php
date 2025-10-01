<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $admin = Auth::guard('admin')->user();

        if ($admin && in_array($admin->role, $roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}


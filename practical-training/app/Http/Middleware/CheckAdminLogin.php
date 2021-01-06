<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminLogin {

    public function handle($request, Closure $next) {
        if (!auth()->check()) {
            return redirect(route('admin.login'))->withErrors(['error' => '尚未登录！']);
        }
        return $next($request);
    }
}

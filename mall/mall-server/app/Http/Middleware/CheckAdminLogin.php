<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminLogin {

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next) {
        if (!auth()->check()) {
            return response()->json(Result::error2("尚未登录！"));
        }
        return $next($request);
    }
}

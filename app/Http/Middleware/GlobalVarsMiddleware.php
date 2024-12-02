<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\UserInfoPublic;
use App\Models\PostMemories;

class GlobalVarsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        view()->share('users', User::all());
        view()->share('info', UserInfoPublic::all());
        view()->share('memories', PostMemories::all());

        return $next($request);
    }
}

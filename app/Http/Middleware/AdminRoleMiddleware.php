<?php

namespace App\Http\Middleware;

use App\Models\Roles;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->role_id !== Roles::getRoleAdministrator()){
            throw new AuthenticationException("Unauthenticated");
        }

        return $next($request);
    }
}

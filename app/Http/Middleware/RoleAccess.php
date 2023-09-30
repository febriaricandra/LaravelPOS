<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // $user = auth()->user();

        // if ($user->role == $role) {
        //     return $next($request);
        // }

        // return redirect('/');
        if ($request->user()->role !== $role) {
            return new Response('Unauthorized', 403);
        }

        return $next($request);
    }
}

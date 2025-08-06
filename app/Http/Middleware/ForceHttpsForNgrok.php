<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttpsForNgrok
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            str_ends_with($request->getHost(), '.ngrok.io') ||
            str_ends_with($request->getHost(), '.ngrok-free.app')
        ) {
            $request->server->set('HTTPS', 'on');
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use App\Http\Requests\AuthWithTokenRequest;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProviderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $providers = config('services.providers');
        if (!in_array($request->route('provider'), $providers)) {
            $providersString = implode(', ', $providers);
            return response()->json(
                [
                    'status' => false,
                    'message' => "Please login using provider with the following: {$providersString}",
                ], 422);
        }
        return $next($request);
    }
}

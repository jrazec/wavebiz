<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
// import log here
use Illuminate\Support\Facades\Log;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        try {
            // Log the Authorization header to verify the token is being passed
            \Log::info('Authorization Header: ' . $request->header('Authorization'));

            // Get the token from the request header
            $token = $request->bearerToken();

            if (!$token) {
                \Log::error('No token found in the request');
                return response()->json(['message' => 'Token is missing'], 401);
            }

            // Try to authenticate the user with the token
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                \Log::error('User not authenticated');
                return response()->json(['message' => 'Token is invalid'], 401);
            }

            // Check if the user's role matches any of the required roles
            if (!in_array(strtolower($user->fldRoleName), array_map('strtolower', $roles))) {
                return response()->json([
                    'message' => 'Forbidden. Required role: ' . implode(', ', $roles),
                    'roleName' => $user->fldRoleName,
                ], 403);
            }

            return $next($request);

        } catch (JWTException $e) {
            \Log::error('JWTException: ' . $e->getMessage());
            return response()->json(['message' => 'Token is invalid or expired'], 401);
        } catch (\Exception $e) {
            \Log::error('Exception: ' . $e->getMessage());
            return response()->json(['message' => 'An unexpected error occurred'], 500);
        }
    }
}

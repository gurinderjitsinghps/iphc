<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next, ...$roles){
        if (!auth()->check()) {
            return response()->json(['status'=>false,'message' => 'Unauthorized'], 401);
        }

        // Get the authenticated user
        $user = auth()->user();
        $configRoles = config('roles');
        $configRoles = array_keys($configRoles);
        if(!in_array($user->role,$configRoles)){
            return response()->json(['status'=>false,'message' => 'Invalid Role'], 403);
        }
        // Check if the user's role is one of the allowed roles
        if ($user->role && in_array($user->role, $roles)) {
            if($user->role =='external_auditor_temp_role'){
                $givenTimestamp = Carbon::parse($user->expiry);
                $currentTimestamp = Carbon::now();

            if ($currentTimestamp->greaterThan($givenTimestamp)) {
                return response()->json(['status'=>false,'message' => 'Temp role expired.'], 403);
            } 
            }
            return $next($request);
        }

        return response()->json(['status'=>false,'message' => 'Forbidden'], 403);
}

}

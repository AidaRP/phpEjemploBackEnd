<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FsdEjemploValencia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Log::info("FSD Middleware");
        
        $userId = auth()->user()->id;
        $userRoles = User::find($userId)->roles->toArray();

        foreach ($userRoles as $role) {
            if ($role['role'] == 'employee') {
                return $next($request);
            }

        }

        return response()->json('No tienes permisos', 401);        
    }
}

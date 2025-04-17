<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tenant;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenantCode = $request->route('code');
        
        if (!$tenantCode) {
            return redirect()->route('login');
        }

        $tenant = Tenant::where('code', $tenantCode)->first();
        
        if (!$tenant) {
            abort(404, 'Tenant not found');
        }

        // Store tenant in the request for later use
        $request->merge(['tenant' => $tenant]);
        
        return $next($request);
    }
} 
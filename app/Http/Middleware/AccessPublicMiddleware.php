<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccessPublicMiddleware
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
        $headers = $request->headers->all();
        
        if( $headers && isset($headers["x-api-key"]) && strtolower($headers["x-api-key"][0]) == "guest" )
        {
            return $next($request);
        }
       
        return response()->json(["message" => "Unauthenticated."]); 
    }
}

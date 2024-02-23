<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckoutSuccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->path() == 'checkout/success')
        {
            if($request->session()->has('checkout_success'))
            {
                return $next($request);
            }
            else
            {
                return abort(404);
            }
        }
        return $next($request);
    }
}

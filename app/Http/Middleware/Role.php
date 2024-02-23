<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    protected $config = [
        'role' => 'admin',
        'permission' => 'admin',
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->hasRole($this->getRoleByParameters($request)))
        {
            return $next($request);
        }
        abort(403, 'Unauthorize');
    }



    protected function getRoleByParameters($request)
    {
        return $this->config[$request->route()->parameters['controller']] ?? null;
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::user()->hasRole('admin')) //If user has this //permission
        {
            return $next($request);
        }
        if (!Auth::user()->hasPermissionTo("read")){
            return redirect()->guest('/');
            //abort('401');
        }
        if ($request->is('*/create'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('write'))
            {
                abort('401');
            }
            else {
                return $next($request);
            }
        }

        if ($request->is('*/*/edit')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('write')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('write')) {
                abort('401');
            }
            else
            {
                return $next($request);
            }
        }

        return $next($request);
    }
}
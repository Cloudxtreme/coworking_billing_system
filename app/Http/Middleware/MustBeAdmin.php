<?php

namespace App\Http\Middleware;

use Closure;

class MustBeAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->user();

        if($user && $user->isAdmin() == '')
        {
            return $next($request);
        }

        abort(404,'Nice try :)');
    }
}

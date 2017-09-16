<?php

namespace App\Http\Middleware;

use Closure;

class CanRegisterMiddleware
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
        // check if registration is disabled
        if( config( 'app.can_register', false ) == false ) {
            return redirect()->route( 'errors', [ 'code' => 'registration-disabled' ] );
        }
        return $next($request);
    }
}

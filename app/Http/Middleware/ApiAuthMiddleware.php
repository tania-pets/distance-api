<?php

namespace App\Http\Middleware;

use Closure;
use App\ResponseError;


class ApiAuthMiddleware
{
    /**
     * Handle an incoming api request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->auth_token) {
            $error = new ResponseError(401, 'auth_token_missing', 'Please attach auth_token to your request');
        }
        else if (!$request->username) {
            $error = new ResponseError(401, 'username_missing', 'Please attach username to your request');
        }

        //Validate token and username here
        /**************************/
        return isset($error) ? $error->getResponse() : $next($request);
    }
}

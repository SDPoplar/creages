<?php
namespace App\Http\Middleware;
use Closure;
use \App\Interfaces\Auth as IAuth;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $request->merge([
            'me' => new class implements IAuth {
                public function get_id() : string {
                    return '1';
                }
            },
        ]);
        return $next($request);
    }
}


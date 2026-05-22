<?php
namespace App\Middlewares;

use \App\Services\Auth\AuthToken;
use Mxs\Inputs\{
    RootInput,
    HttpRequest
};
use Mxs\Exceptions\Runtimes\Unauthorized;

class Auth implements \Mxs\Routes\MiddlewareInterface
{
    /**
     * Handle an incoming request.
     *
     * @param  \Mxs\Inputs\RootInput  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(RootInput $request, \Closure $next): mixed
    {
        if ($request instanceof HttpRequest) {
            $token = $this->parseHttpToken($request);
            $request->appendMid('me', $token);
        } else {
            $request->appendMid('me', new AuthToken('1'));
        }

        return $next($request);
    }

    private function parseHttpToken(HttpRequest $in): AuthToken
    {
        $tokenStr = $in->header('Authorization');
        empty($tokenStr) and throw Unauthorized::missing();
        $token = AuthToken::load($tokenStr);
        is_null($token) and throw Unauthorized::invalid();
        return $token;
    }
}


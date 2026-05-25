<?php
namespace App\Middlewares;

class Cors implements \Mxs\Routes\MiddlewareInterface
{
    #[\Override]
    public function handle(\Mxs\Inputs\RootInput $in, \Closure $next): mixed
    {
        header("Access-Control-Allow-Methods: GET,POST,PUT,HEAD,DELETE");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Authorization, Content-Type");
        return $next($in);
    }
}

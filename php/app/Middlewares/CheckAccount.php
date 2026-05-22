<?php
namespace App\Middlewares;

use App\Exceptions\Unauthorized as ErrUnauthorized;
use App\Services\Auth\AuthToken;
use App\Services\Account\Surface as AccountService;

class CheckAccount implements \Mxs\Routes\MiddlewareInterface
{
    #[\Override]
    public function handle(\Mxs\Inputs\RootInput $in, \Closure $next): mixed
    {
        $me = (fn($e): ?AuthToken => $e instanceof AuthToken ? $e : null)($in->mid('me'));
        is_null($me) and throw ErrUnauthorized::invalid();
        $found = new AccountService()->getAccount($me->account_id);
        is_null($found) and throw ErrUnauthorized::invalid();
        $found->isNormal() or throw ErrUnauthorized::accountStatusNotAllowed($found->status);
        return $next($in);
    }
}

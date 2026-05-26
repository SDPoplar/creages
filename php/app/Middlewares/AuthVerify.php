<?php
namespace App\Middlewares;

use Mxs\Inputs\HttpRequest;
use Mxs\Exceptions\Runtimes\Unauthorized as ErrUnauthorized;
use App\Exceptions\AccountCannotAuth as ErrAccountCannotAuth;
use App\Services\Auth\AuthToken;
use App\Services\Account\Surface as AccountService;

class AuthVerify extends Auth
{
    #[\Override]
    protected function parseHttpToken(HttpRequest $in): AuthToken
    {
        $me = parent::parseHttpToken($in);
        $found = new AccountService()->getAccount($me->account_id);
        is_null($found) and throw ErrUnauthorized::invalid();
        $found->isNormal() or throw ErrAccountCannotAuth::accountStatusNotAllowed($found->status);
        return $me;
    }
}

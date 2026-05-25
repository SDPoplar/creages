<?php
namespace App\Controllers;

use Mxs\Frame\ExecReturn as R;
use App\Inputs\AuthedEmpty as InAuthedEmpty;
use App\Inputs\Account\{
    //  auth inputs
    LoginWithPwd as InLoginWithPwd,
    Logout as InLogout,
    Regist as InRegist,

    //  account inputs
    Edit as InEdit,
};

use App\Exceptions\{
    AppRunCode,
    SaveDataFailed as ErrSaveFailed,
    RecordExists as ErrRecordExists,
    AccountCannotAuth as ErrAccountCannotAuth,
    AuthFailed as ErrAuthFailed,
};

use App\Services\Account\{
    Surface as AccountSrv,
    Instance as AccountIns,
};
use App\Services\Auth\AuthToken;

class Account
{
    public function verifyToken(InAuthedEmpty $in)
    {
        return R::succ([
            'token' => $in->me->token,
            'expire_at' => $in->me->expire_at,
        ]);
    }

    public function loginWithPwd(InLoginWithPwd $in)
    {
        $account = new AccountSrv()->findByAccount($in->account);
        is_null($account) and throw new ErrAuthFailed();
        $account->isNormal() or throw ErrAccountCannotAuth::accountStatusNotAllowed($account->status);
        $account->checkPassword($in->password) or throw new ErrAuthFailed();
        $token = new AuthToken($account->id);
        $token->cache();
        return R::succ([
            'token' => $token->token,
            'expire_at' => $token->expire_at,
        ]);
    }

    public function logout(InLogout $in)
    {
        $tokenToRemove = $in->me->token;
        var_dump($tokenToRemove); exit;
    }

    public function regist(InRegist $in)
    {
        $srv = new AccountSrv();
        $srv->accountExists($in->account) and throw ErrRecordExists::account($in->account);
        $saved = $srv->registAccount($in->account, $in->password, $in->nickname);
        is_null($saved) and throw new ErrSaveFailed(AppRunCode::SaveAccountDataFailed->value);
        return R::created($saved->id);
    }

    public function edit(InEdit $in)
    {}
}

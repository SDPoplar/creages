<?php
namespace App\Controllers;

use Mxs\Frame\ExecReturn as R;
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
};

use App\Services\Account\{
    Surface as AccountSrv,
    Instance as AccountIns,
};

class Account
{
    public function loginWithPwd(InLoginWithPwd $in)
    {}

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

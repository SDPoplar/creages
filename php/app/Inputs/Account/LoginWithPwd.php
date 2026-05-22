<?php
namespace App\Inputs\Account;

use Mxs\Exceptions\Runtimes\InvalidInput;

readonly class LoginWithPwd
{
    public function __construct(\Mxs\Inputs\HttpRequest $in)
    {
        $account = $in->input('account');
        empty($account) and throw new InvalidInput('account');
        $this->account = $account;

        $this->password = $in->inputPassword('password');
    }

    public string $account;
    public string $password;
}
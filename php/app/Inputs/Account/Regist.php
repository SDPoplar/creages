<?php
namespace App\Inputs\Account;

readonly class Regist
{
    public function __construct(\Mxs\Inputs\HttpRequest $in)
    {
        $this->account = $in->inputString('account', 1, 64);
        $this->password = $in->inputPassword();
        $nick = $in->inputString('nickname', maxLen: 64);
        if (empty($nick)) {
            $nick = sprintf('cu_%d%03d', time(), mt_rand(1, 999));
        }
        $this->nickname = $nick;
    }

    public string $account;
    public string $password;
    public string $nickname;
}
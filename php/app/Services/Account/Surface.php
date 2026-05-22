<?php
namespace App\Services\Account;

use Mxs\Services\Pdo\Feature as F;
use App\Exceptions\{
    AppRunCode,
    DataBroken as ErrDataBroken,
};

class Surface extends \Mxs\Services\Pdo\Postgre
{
    #[\Override]
    protected function selectTable(mixed $table_route): string
    {
        return 'account';
    }

    public function getAccount(int $account_id): ?Instance
    {
        $found = $account_id > 0 ? $this->getOne(F::eq('id', $account_id)) : null;
        if (empty($found)) {
            return null;
        }
        //  var_dump($found); exit;
        $status = Status::tryFrom(intval($found['status']));
        is_null($status) and throw new ErrDataBroken(AppRunCode::AccountStatusBroken->value);
        return new Instance(
            intval($found['id']),
            $found['account'],
            $found['nickname'],
            $found['password'],
            $status,
        );
    }

    public function accountExists(string $account): bool
    {
        return $this->count(F::eq('account', $account)) > 0;
    }

    public function registAccount(string $account, string $password, string $nickname): ?Instance
    {
        $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
        $insertId = $this->insertOne([
            'account' => $account,
            'password' => $hashed_pwd,
            'nickname' => $nickname,
        ]);
        if ($insertId === false) {
            return null;
        }
        return new Instance($insertId, $account, $nickname, $hashed_pwd, Status::Unverify);
    }
}

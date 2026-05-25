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

    public function findByAccount(string $account): ?Instance
    {
        $found = empty($account) ? null : $this->getOne(F::eq('account', $account));
        return $found ? self::dataToInstance($found) : null;
    }

    public function getAccount(int $account_id): ?Instance
    {
        $found = $account_id > 0 ? $this->getOne(F::eq('id', $account_id)) : null;
        return $found ? self::dataToInstance($found) : null;
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

    private static function dataToInstance(array $data) : Instance
    {
        $status = Status::tryFrom(intval($data['status']));
        is_null($status) and throw new ErrDataBroken(AppRunCode::AccountStatusBroken->value);
        return new Instance(
            intval($data['id']),
            $data['account'],
            $data['nickname'],
            $data['password'],
            $status,
        );
    }
}

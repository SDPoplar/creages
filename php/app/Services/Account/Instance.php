<?php
namespace App\Services\Account;

readonly class Instance
{
    public function __construct(
        public int $id,
        public string $account,
        public string $nickname,
        private string $password,
        public Status $status,
    ) {}

    public function isNormal(): bool
    {
        return $this->status === Status::Normal;
    }

    public function isFrozen(): bool
    {
        return $this->status === Status::Frozen;
    }

    public function checkPassword(string $pwd): bool
    {
        return password_verify($pwd, $this->password);
    }
}
<?php
namespace App\Exceptions;

use App\Services\Account\Status as AccountStatus;

class AccountCannotAuth extends \Mxs\Exceptions\Runtimes\MxsRuntime
{
    public static function accountStatusNotAllowed(int|\App\Services\Account\Status $codeOrStatus): self
    {
        $code = is_int($codeOrStatus) ? $codeOrStatus : match($codeOrStatus) {
            AccountStatus::Unverify => AppRunCode::AccountNotVerified->value,
            AccountStatus::Frozen => AppRunCode::AccountFrozen->value,
            AccountStatus::Denied => AppRunCode::AccountDenied->value,
        };
        return new self($code, 'account status not allowed');
    }

    protected function __construct(int $code, string $message)
    {
        parent::__construct(\SeaDrip\Http\Status::Forbidden, $code, $message);
    }
}

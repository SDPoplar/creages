<?php
namespace App\Exceptions;

use App\Services\Account\Status as AccountStatus;

class Unauthorized extends \Mxs\Exceptions\Runtimes\Unauthorized
{
    public static function unknownAccount(): self
    {
        return new self(AppRunCode::UnknownAccount->value, "Unknown account");
    }

    public static function accountStatusNotAllowed(int|\App\Services\Account\Status $codeOrStatus): self
    {
        $code = is_int($codeOrStatus) ? $codeOrStatus : match($codeOrStatus) {
            AccountStatus::Unverify => AppRunCode::AccountNotVerified->value,
            AccountStatus::Frozen => AppRunCode::AccountFrozen->value,
            AccountStatus::Denied => AppRunCode::AccountDenied->value,
        };
        return new self($code, 'account status not allowed');
    }
}

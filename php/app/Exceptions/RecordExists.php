<?php
namespace App\Exceptions;

class RecordExists extends \Mxs\Exceptions\Runtimes\MxsRuntime
{
    public function __construct(int $code, string $record_describe)
    {
        parent::__construct(
            \SeaDrip\Http\Status::Forbidden,
            $code,
            $record_describe . ' exists'
        );
    }

    public static function account(string $account): self
    {
        return new self(AppRunCode::AccountExists->value, "account [{$account}]");
    }

    
}

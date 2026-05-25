<?php
namespace App\Exceptions;

class AuthFailed extends \Mxs\Exceptions\Runtimes\Unauthorized
{
    public function __construct()
    {
        parent::__construct(
            AppRunCode::WrongAccountOrPassword->value,
            'unknown account or wrong password'
        );
    }
}

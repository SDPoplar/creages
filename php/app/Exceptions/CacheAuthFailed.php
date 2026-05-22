<?php
namespace App\Exceptions;

class CacheAuthFailed extends \Mxs\Exceptions\Runtimes\MxsRuntime
{
    public function __construct()
    {
        parent::__construct(
            \SeaDrip\Http\Status::InternalServerError,
            AppRunCode::CacheAuthFailed->value,
            "Cache auth token failed"
        );
    }
}

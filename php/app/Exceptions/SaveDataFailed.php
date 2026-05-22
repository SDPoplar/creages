<?php
namespace App\Exceptions;

class SaveDataFailed extends \Mxs\Exceptions\Runtimes\MxsRuntime
{
    public function __construct(int $code)
    {
        parent::__construct(
            \SeaDrip\Http\Status::InternalServerError,
            $code,
            'save data failed'
        );
    }
}

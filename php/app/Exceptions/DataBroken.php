<?php
namespace App\Exceptions;

class DataBroken extends \Mxs\Exceptions\Runtimes\MxsRuntime
{
    public function __construct(int $code)
    {
        parent::__construct(
            \SeaDrip\Http\Status::InternalServerError,
            $code,
            "data broken"
        );
    }
}

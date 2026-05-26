<?php
namespace App\Inputs;

use App\Services\Auth\AuthToken;

trait AuthedTrait
{
    protected function initAuthed(\Mxs\Inputs\HttpRequest $in)
    {
        $ins = $in->mid('me');
        ($ins instanceof AuthToken) or throw \Mxs\Exceptions\Runtimes\Unauthorized::missing();
        $this->me = $ins;
    }

    public readonly \App\Services\Auth\AuthToken $me;
}

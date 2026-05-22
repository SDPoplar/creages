<?php
namespace App\Inputs;

trait AuthedTrait
{
    protected function initAuthed(\Mxs\Inputs\HttpRequest $in)
    {
        $this->me = $in->mid('me');
    }

    public readonly \App\Services\Auth\AuthToken $me;
}

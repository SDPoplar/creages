<?php
namespace App\Inputs;

class AuthedEmpty
{
    use AuthedTrait;

    public function __construct(\Mxs\Inputs\HttpRequest $in)
    {
        $this->initAuthed($in);
    }
}

<?php
namespace App\Inputs\Account;

class Logout
{
    use \App\Inputs\AuthedTrait;

    public function __construct(\Mxs\Inputs\RootInput $in)
    {
        $this->initAuthed($in);
    }
}

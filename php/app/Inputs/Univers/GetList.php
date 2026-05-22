<?php
namespace App\Inputs\Univers;

class GetList
{
    use \App\Inputs\AuthedTrait;

    public function __construct(\Mxs\Inputs\RootInput $in)
    {
        $this->initAuthed($in);
    }
}

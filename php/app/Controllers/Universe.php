<?php
namespace App\Controllers;

use App\Inputs\Univers\{
    GetList as InGetList,
    Add as InAdd
};

class Universe
{
    public function getList(InGetList $in)
    {
        return 'hello';
    }

    public function add(InAdd $in)
    {}
}

<?php
namespace App\Services\Account;

enum Status: int
{
    case Unverify = 0;
    case Normal = 1;
    case Frozen = 2;
    case Denied = 3;
}

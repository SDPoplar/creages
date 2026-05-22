<?php
namespace App\Exceptions;

enum AppRunCode: int
{
    case CacheAuthFailed = 1000;
    case AccountNotVerified = 1010;
    case AccountFrozen = 1011;
    case AccountDenied = 1012;

    case UnknownAccount = 2000;
    case AccountExists = 2001;
    case SaveAccountDataFailed = 2002;
    case AccountIdBroken = 2011;
    case AccountStatusBroken = 2012;
}

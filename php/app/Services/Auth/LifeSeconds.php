<?php
namespace App\Services\Auth;

enum LifeSeconds: int
{
    case Forever = -1;
    case OneDay = 86400;
    case OneWeek = 604800;
    case OneMonth = 2592000;
}

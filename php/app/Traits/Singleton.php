<?php
namespace App\Traits;

trait Singleton
{
    public static function GetInstance() : self {
        $clsName = static::class;
        return self::$_ins ??= new $clsName();
    }

    private static ?self $_ins;
}


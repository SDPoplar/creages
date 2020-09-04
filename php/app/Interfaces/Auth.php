<?php
namespace App\Interfaces;

interface Auth
{
    //  public static function Token( string $token ) : Auth;

    public function get_id() : string;
}


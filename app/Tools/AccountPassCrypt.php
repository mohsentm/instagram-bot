<?php


namespace App\Tools;

use Illuminate\Support\Facades\Crypt;

class AccountPassCrypt
{

    public static function encrypt(string $string, string $salt = ''): string
    {
        return Crypt::encryptString($string . $salt);
    }

    public static function decrypt(string $hash, string $salt = ''): string
    {
        $string =  Crypt::decryptString($hash);
        return str_replace($salt,'', $string);
    }
}

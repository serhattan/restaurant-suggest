<?php

namespace App\Helpers;


class Helper
{
    const English = 'en';
    const Deutsch = 'de';
    const French = 'fr';
    const Russian = 'ru';
    const Spanish = 'sp';
    const Turkish = 'tr';
    const STATUS_ACTIVE = 'active';
    const STATUS_DELETED = 'deleted';

    public static function generateId($len = 32)
    {
        return bin2hex(openssl_random_pseudo_bytes($len / 2));
    }

    public static function isNull($data = null)
    {
        return $data === null || $data === '';
    }
}
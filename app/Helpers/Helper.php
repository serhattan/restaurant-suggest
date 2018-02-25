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
    const ADD = 'Added';
    const UPDATE = 'Updated';
    const REMOVE = 'Removed';
    const GENERATE = 'Generated';
    const USER_TABLE = 'user';
    const RESTAURANT_USER_TABLE = 'restaurant_user';
    const RESTAURANT_TABLE = 'restaurant';
    const GROUP_USER_TABLE = 'group_user';
    const GROUP_MEMBER_TABLE = 'group_member';
    const GROUP_TABLE = 'group';
    const GENERATE_TABLE = 'generate';

    public static function generateId($len = 32)
    {
        return bin2hex(openssl_random_pseudo_bytes($len / 2));
    }

    public static function isNull($data = null)
    {
        return $data === null || $data === '';
    }
}
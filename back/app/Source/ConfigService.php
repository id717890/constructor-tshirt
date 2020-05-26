<?php
namespace App\Source;

class ConfigService
{
    public static function all_sizes()
    {
        return ['6XS', '5XS', '6XS-5XS', '4XS', '3XS', '4XS-3XS', '2XS', 'XS', 'S', 'M', 'L', 'XL', '2ХL', '3ХL', '2ХL-3ХL'];
    }

    public static function GUID()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double)microtime() * 10000);
            //optional for php 4.2.0 and up.
            $set_charid = strtoupper(md5(uniqid(rand(), true)));
            $set_hyphen = chr(45);
            // "-"
            $set_uuid = substr($set_charid, 0, 8) . $set_hyphen
                . substr($set_charid, 8, 4) . $set_hyphen
                . substr($set_charid, 12, 4) . $set_hyphen
                . substr($set_charid, 16, 4) . $set_hyphen
                . substr($set_charid, 20, 12);
//                . chr(125);
            // "}"
            return $set_uuid;
        }
//        return trim(com_create_guid(), '{}');
    }

}
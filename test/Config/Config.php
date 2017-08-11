<?php

namespace Config;

use Interfaces\DbInterface;

class Config
{
    private static $db = null;
    private static $host = null;


    public static function init(array $option)
    {
        if(isset($option['db']))
        {
            self::$db = $option['db'];
        }

        if(isset($option['host']))
        {
            self::$host = $option['host'];
        }
    }

    public static function getDb() : DbInterface
    {
        if(empty(self::$db))
        {
            throw new \Exception('Invalid db');
        }
        return self::$db;
    }

    public static function getHost() : string
    {
        return self::$host;
    }
}
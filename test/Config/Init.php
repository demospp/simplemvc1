<?php

namespace Config;

class Init
{
    public static function init()
    {
        $option = [];
        $option['host'] = 'localhost';
        $option['db_name'] = 'test';
        $option['user'] = 'root';
        $option['pass'] = '123456';

        $db = new MyDb($option);

        $opt = [];
        $opt['db'] = $db;
        $opt['host'] = 'localhost';

        Config::init($opt);
    }
}
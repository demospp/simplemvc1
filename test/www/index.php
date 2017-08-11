<?php
//echo(2);

error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

\Config\Init::init();
$router  = new \Config\Router();
$router->proc();
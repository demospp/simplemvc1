<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1ef5a009edff42198c436f854d898ff9
{
    public static $fallbackDirsPsr0 = array (
        0 => __DIR__ . '/../..' . '/',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr0 = ComposerStaticInit1ef5a009edff42198c436f854d898ff9::$fallbackDirsPsr0;

        }, null, ClassLoader::class);
    }
}

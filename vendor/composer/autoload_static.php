<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2c6681bee38debbdc35e192439e466ec
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PayPal' => 
            array (
                0 => __DIR__ . '/..' . '/paypal/rest-api-sdk-php/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2c6681bee38debbdc35e192439e466ec::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2c6681bee38debbdc35e192439e466ec::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit2c6681bee38debbdc35e192439e466ec::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit2c6681bee38debbdc35e192439e466ec::$classMap;

        }, null, ClassLoader::class);
    }
}

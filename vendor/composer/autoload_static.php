<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaf409e88b2505cccee2717284f27a999
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'A' => 
        array (
            'App\\ChezMamy\\tests\\' => 19,
            'App\\ChezMamy\\models\\' => 20,
            'App\\ChezMamy\\helpers\\' => 21,
            'App\\ChezMamy\\controllers\\' => 25,
            'App\\ChezMamy\\config\\' => 20,
            'App\\ChezMamy\\Views\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'App\\ChezMamy\\tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests',
        ),
        'App\\ChezMamy\\models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'App\\ChezMamy\\helpers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/helpers',
        ),
        'App\\ChezMamy\\controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
        'App\\ChezMamy\\config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'App\\ChezMamy\\Views\\' => 
        array (
            0 => __DIR__ . '/../..' . '/views',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitaf409e88b2505cccee2717284f27a999::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaf409e88b2505cccee2717284f27a999::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitaf409e88b2505cccee2717284f27a999::$classMap;

        }, null, ClassLoader::class);
    }
}

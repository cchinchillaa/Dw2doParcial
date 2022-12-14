<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd82363cbe80e324403447ed60335379f
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd82363cbe80e324403447ed60335379f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd82363cbe80e324403447ed60335379f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd82363cbe80e324403447ed60335379f::$classMap;

        }, null, ClassLoader::class);
    }
}

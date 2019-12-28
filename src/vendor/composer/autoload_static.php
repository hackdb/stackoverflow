<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit039fa707858396db4dc22d37c55fa4fe
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rct567\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rct567\\' => 
        array (
            0 => __DIR__ . '/..' . '/rct567/dom-query/src/Rct567',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit039fa707858396db4dc22d37c55fa4fe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit039fa707858396db4dc22d37c55fa4fe::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

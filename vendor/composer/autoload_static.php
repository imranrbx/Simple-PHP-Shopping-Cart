<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc22870a2439db0041d920f4ca4f13d29
{
    public static $prefixLengthsPsr4 = array (
        'v' => 
        array (
            'voku\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'voku\\' => 
        array (
            0 => __DIR__ . '/..' . '/voku/cart/src/voku',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc22870a2439db0041d920f4ca4f13d29::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc22870a2439db0041d920f4ca4f13d29::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

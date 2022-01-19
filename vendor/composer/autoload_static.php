<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit40ccf4df6286860f8070cd111aec055c
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Aminrafiei\\Chunker\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Aminrafiei\\Chunker\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit40ccf4df6286860f8070cd111aec055c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit40ccf4df6286860f8070cd111aec055c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit40ccf4df6286860f8070cd111aec055c::$classMap;

        }, null, ClassLoader::class);
    }
}
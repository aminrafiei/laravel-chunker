<?php

namespace Aminrafiei\Chunker\Contracts;


use SplFileInfo;

interface FileServiceContract
{
    const APPEND = 'APPEND';
    const WRITE = 'WRITE';
    const TYPES = [
        self::APPEND => 'a+b',
        self::WRITE  => 'w+b',
    ];

    public function put(string $path, SplFileInfo $file, string $name, $mode = self::WRITE): bool;
}

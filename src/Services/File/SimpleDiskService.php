<?php

namespace Aminrafiei\Chunker\Services\File;

use Aminrafiei\Chunker\Contracts\FileServiceContract;

class SimpleDiskService implements FileServiceContract
{
    public function put(string $path, \SplFileInfo $file, string $name, $mode = FileServiceContract::WRITE): bool
    {
        $stream = fopen(is_string($file) ? $file : $file->getRealPath(), 'r');
        if (!file_exists($path)) {
            mkdir($path, 0776, true);
        }
        $file = fopen($fileName = $path . '/' . $name, FileServiceContract::TYPES[$mode] ?? 'w+b');
        stream_copy_to_stream($stream, $file);
        chmod($fileName,0776);
        fclose($file);

        return true;
    }
}

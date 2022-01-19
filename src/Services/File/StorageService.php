<?php

namespace Aminrafiei\Chunker\Services\File;

use Aminrafiei\Chunker\Contracts\FileServiceContract;
use Illuminate\Support\Facades\Storage;

class StorageService implements FileServiceContract
{
    public function put(string $path, \SplFileInfo $file, string $name, $mode = FileServiceContract::WRITE): bool
    {
        if ($mode == FileServiceContract::APPEND){
            return Storage::append($path,fopen(is_string($file) ? $file : $file->getRealPath(), 'r'));
        }

        return Storage::writeStream($path,fopen(is_string($file) ? $file : $file->getRealPath(), 'r'));
    }
}

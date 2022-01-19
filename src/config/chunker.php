<?php

return [
    'save_path' => storage_path('chunker'),
    'storage_driver' => \Aminrafiei\Chunker\Services\File\SimpleDiskService::class,
];

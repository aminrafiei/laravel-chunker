
# Laravel Chunker

This package help you handle chunk file request and finally make it to one file.


## Installation

You can download it via composer.
```
  composer require aminrafiei/laravel-chunker
  php artisan migrate
```
For publish config files:
```bash
  php artisan vendor:publish
``` 


### Requirements:

- PHP v7.3 or above
- Laravel v7.0 or above


### Note:

This package use **disk** driver for store files and write chunk files in laravel storage path if you need another path or another driver use can edit in config file.

Also you can implement your own storage driver by implement ```FileServiceContract```

```php
return [
    'save_path' => storage_path('chunker'),
    'storage_driver' => \Aminrafiei\Chunker\Services\File\SimpleDiskService::class,
];

````
## Usage/Examples

In 3 steps you can handle chunk files!

First **init** then make in **progress** then make it **done**!

### 1) Init

For initialize chunk file porcess you should use:

```php
  use Aminrafiei\Chunker\Facades\Chunker;

  $chunkId = Chunker::init($name, $type, $totalChunks, $totalSize);
```

### 2) Progress

For handle chunk files and store use should use:

```php
  use Aminrafiei\Chunker\Facades\Chunker;

  Chunker::progress($chunkId, $chunkNumber, $file);
```

### 3) Done

At the end when all chunk files uploaded for combine to one file you should call:

```php
  use Aminrafiei\Chunker\Facades\Chunker;

  $response = Chunker::done($chunkId);
  $path = $response->getRealPath();
```



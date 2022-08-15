<?php

namespace Aminrafiei\Chunker;

use Aminrafiei\Chunker\Contracts\FileServiceContract;
use Aminrafiei\Chunker\Services\File\SimpleDiskService;
use Illuminate\Support\ServiceProvider;

class ChunkerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->publishes([
            __DIR__ . '/config/chunker.php' => config_path('chunker.php'),
        ]);
        $this->app->singleton(FileServiceContract::class, config('chunker.storage_driver', SimpleDiskService::class));
        $this->app->singleton('chunker', Chunker::class);
    }

}

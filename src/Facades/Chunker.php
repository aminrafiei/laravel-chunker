<?php

namespace Aminrafiei\Chunker\Facades;

use Illuminate\Support\Facades\Facade;

class Chunker extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'chunker';
    }
}

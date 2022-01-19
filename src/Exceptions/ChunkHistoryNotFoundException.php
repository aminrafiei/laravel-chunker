<?php

namespace Aminrafiei\Chunker\Exceptions;

use Exception;

class ChunkHistoryNotFoundException extends Exception
{
    protected $code = 404;
}

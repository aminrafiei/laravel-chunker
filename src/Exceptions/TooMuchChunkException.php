<?php

namespace Aminrafiei\Chunker\Exceptions;

use Exception;

class TooMuchChunkException extends Exception
{
    protected $code = 422;
}

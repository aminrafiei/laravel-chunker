<?php

namespace Aminrafiei\Chunker\Exceptions;

use Exception;

class NotEnoughChunkException extends Exception
{
    protected $code = 422;
}

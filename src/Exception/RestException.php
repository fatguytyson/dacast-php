<?php

namespace FGC\DacastPhp\Exception;

use Exception;
use GuzzleHttp\Exception\GuzzleException;

class RestException extends Exception
{
    public function __construct(GuzzleException $exception)
    {
        parent::__construct($exception->getMessage(), $exception->getCode(), $exception);
    }
}

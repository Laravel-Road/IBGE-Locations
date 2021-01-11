<?php

namespace LaravelRoad\IBGELocaltions\Exceptions;

use Exception;
use Throwable;

class DriverUnsupportedException extends Exception
{
    /**
     * ReportTypeUnsupported constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = 'Driver unsupported', $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

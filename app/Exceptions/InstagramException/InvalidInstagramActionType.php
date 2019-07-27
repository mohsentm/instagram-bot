<?php

namespace App\Exceptions\InstagramException;

use Exception;
use Throwable;

class InvalidInstagramActionType extends Exception
{
    public function __construct($message = "Invalid instagram action type", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

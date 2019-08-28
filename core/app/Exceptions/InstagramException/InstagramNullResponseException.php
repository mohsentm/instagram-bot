<?php

namespace App\Exceptions\InstagramException;

use Exception;
use Throwable;

class InstagramNullResponseException extends Exception
{
    public function __construct($message = 'The null response has been received from the Instagram server', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

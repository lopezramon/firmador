<?php

namespace App\Exceptions;

use Exception;

class ApiModelException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */

    public $message = '';
    public $code = '';

    public function __construct($message = '', $code = '', Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message  = $message;
        $this->code   = $code;
    }
}

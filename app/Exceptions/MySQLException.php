<?php

namespace App\Exceptions;

use Exception;

class MySQLException extends Exception
{
    public $message = '';
    public $code = '';
    public $details = '';

    public function __construct($message, $code = '', Exception $previous = null)
    {
        $sqlError = $message;
        switch ($code) {
            case '23000':
                $message = 'Registro duplicado';
                break;

            case '22001':
                $message = 'Los valores exceden los limites establecidos';
                break;

            case '01000':
                $message = 'Los valores que intenta agregar han sido truncados';
                break;
            case '42S22':
                $message = 'Columna desconocida';
                break;
            default:
                $message = 'Error Desconocido';
                break;
        }

        parent::__construct($message, intval($code), $previous);
        $this->message  = $message;
        $this->details = $sqlError;
    }
}

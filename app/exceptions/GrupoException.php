<?php

namespace App\Exceptions;

use Exception;

class GrupoException extends Exception {
    function __construct(string $message = "") {
        $this->message = $message;
    }
}

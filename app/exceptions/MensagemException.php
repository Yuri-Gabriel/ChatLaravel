<?php

namespace App\Exceptions;

use Exception;

class MensagemException extends Exception {
    function __construct(string $message = "") {
        $this->message = $message;
    }
}

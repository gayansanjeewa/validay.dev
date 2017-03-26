<?php

namespace App\Exceptions;

use Illuminate\Queue\InvalidPayloadException;

class InvalidDepartmentException extends InvalidPayloadException
{
    protected $message = '';
    protected $code = 404;

    public function __construct($message = 'Product not found')
    {
        parent::__construct();
        $this->message = $message;
    }
}

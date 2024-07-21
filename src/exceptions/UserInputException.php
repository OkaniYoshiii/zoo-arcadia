<?php

namespace App\Exception;

use App\Exception\InputException;

class UserInputException extends InputException
{
    const FORM_ALREADY_SENT = 'form has already been sent with the same data';
    public function __construct(?string $input, string $problem)
    {
        $input = (is_null($input)) ? '' :  '(' . $input . ')';
        $message = 'Invalid user input ' . $input . '. Problem : ' . $problem;
        parent::__construct($message);
    }
}
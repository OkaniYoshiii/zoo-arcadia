<?php

namespace App\Exception;

class UserInputException extends AbstractInputException
{
    const FORM_ALREADY_SENT = 'form has already been sent with the same data';
    public function __construct(?string $input, string $problem)
    {
        $this->input = $input;
        $input = (is_null($input)) ? '' :  '(' . $input . ')';
        $message = 'Invalid user input ' . $input . '. Problem : ' . $problem;
        parent::__construct($message);
    }
}
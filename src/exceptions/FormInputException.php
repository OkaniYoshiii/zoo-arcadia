<?php

use App\Exception\InputException;

class FormInputException extends InputException
{
    const UNDEFINED_VALUE = 'value is undefined';
    const INVALID_CRUD_ACTION = 'value must be either CREATE, UPDATE or DELETE';
    const NOT_A_FILE = 'value is not a file';
    const NOT_NUMERIC = 'value must be numeric';
    const NOT_STRING = 'value must be a string';
    const NOT_ARRAY = 'value must be an array';
    const NOT_DATE = 'value must be a date';
    const WRONG_CSRF_TOKEN = 'wrong csrf token';

    public function __construct(string $input, string $problem)
    {
        $message = 'Invalid form input (' . $input . '). Problem : ' .  $problem . '. Check if your form have all the inputs needed to process it correclty.';

        parent::__construct($message);
    }
}
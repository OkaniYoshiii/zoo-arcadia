<?php

namespace App\Exception;

use Exception;

abstract class AbtractInputException extends Exception
{
    const EMPTY_VALUE = 'value is empty';

    public string $input;

    public function getInput()
    {
        return $this->input;
    }
}
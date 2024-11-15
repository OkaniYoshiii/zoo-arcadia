<?php

namespace App\Exceptions;

use Exception;

abstract class AbstractInputException extends Exception
{
    const EMPTY_VALUE = 'value is empty';
}
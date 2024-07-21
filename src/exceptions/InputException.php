<?php

namespace App\Exception;

use Exception;

class InputException extends Exception
{
    const EMPTY_VALUE = 'value is empty';
}
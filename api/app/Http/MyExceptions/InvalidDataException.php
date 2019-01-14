<?php

namespace App\Http\MyExceptions;
use \Exception;

class InvalidDataException extends Exception
{
    public function __construct() {

        parent::__construct("Invalid user`s data", 400);
    }
}
    
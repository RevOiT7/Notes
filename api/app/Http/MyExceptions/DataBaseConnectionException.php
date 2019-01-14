<?php

namespace App\Http\MyExceptions;
use \Exception;

class DataBaseConnectionException extends Exception
{
    public function __construct() {

        parent::__construct("Bad connection with DB ", 523);
    }
}
    
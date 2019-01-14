<?php

namespace App\Http\MyExceptions;
use \Exception;

class UserAlreadyExistException extends Exception
{
    public function __construct() {

        parent::__construct("User already exists ", 423);
    }
}
    
<?php

namespace App\Http\MyExceptions;
use \Exception;

class UserNotRegisterException extends Exception
{
    public function __construct() {

        parent::__construct("User hasn`t been registered", 401);
    }
}
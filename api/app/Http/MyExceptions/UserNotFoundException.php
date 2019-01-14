<?php

namespace App\Http\MyExceptions;
use \Exception;

class UserNotFoundException extends Exception
{
    public function __construct() {

        parent::__construct("User hasn`t been found ", 404);
    }
}
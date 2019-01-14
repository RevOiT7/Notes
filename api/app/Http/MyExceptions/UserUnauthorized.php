<?php

namespace App\Http\MyExceptions;
use \Exception;

class UserUnauthorized extends Exception
{
    public function __construct() {

        parent::__construct("User hasn`t been authorized", 401);
    }
}
<?php

namespace App\Http\MyExceptions;
use \Exception;

class FolderNotGetTitleException extends Exception
{
    public function __construct() {

        parent::__construct("Invalid title data", 404);
    }
}

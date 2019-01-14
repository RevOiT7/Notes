<?php

namespace App\Http\MyExceptions;
use \Exception;

class FolderParentNotFoundException extends Exception
{
    public function __construct() {

        parent::__construct("Parent folder hasn`t been found ", 404);
    }
}

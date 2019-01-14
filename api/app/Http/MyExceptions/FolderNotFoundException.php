<?php

namespace App\Http\MyExceptions;
use \Exception;

class FolderNotFoundException extends Exception
{
    public function __construct() {

        parent::__construct("Folder hasn`t been found ", 404);
    }
}

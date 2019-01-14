<?php

namespace App\Http\MyExceptions;
use \Exception;

class NoteNotFoundException extends Exception
{
    public function __construct() {

        parent::__construct("Note hasn`t been found ", 404);
    }
}
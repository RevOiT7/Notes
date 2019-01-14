<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Exception;
use \App\Http\MyExceptions\UserNotRegisterException;
use \App\Http\MyExceptions\DataBaseConnectionException;
use Illuminate\Http\JsonResponse;

use \App\Models\MyUser;

class AuthController extends MyAbstractClass
{
    public function authUser(Request $request)
    {
        try {
            $user = new MyUser();
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            if (!$user->find([$user->email, $user->password])){
                throw new UserNotRegisterException();
            }
            return new JsonResponse(['user_id'=>$user->id], 200);
        } catch (Exception $e) {
            return $this->SendError($e);
        }
    }
}

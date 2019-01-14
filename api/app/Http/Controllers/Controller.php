<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function SendError(\Exception $e) {

        return new JsonResponse($e->getMessage(), $e->getCode());
    }

    public static function SendJsonWithHeaders($message, $status, $databaseToken) {
        return response()
            ->json(['message' => $message], $status)
            ->withHeaders(
                [
                    'Authorization' => $databaseToken->access_token,
                    'access-token' => $databaseToken->access_token,
                    'refresh-token' => $databaseToken->refresh_token,
                    'expires-in' => $databaseToken->expires_in
                ]
            );
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MyUser;
use App\Models\Token;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => 'required|string|email|min:5|max:255',
            'password' => 'required|string|min:5',
        ]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return MyAbstractClass|JsonResponse
     */
    public function login(Request $request)
    {
        $validator = $this->validator($request);
        try {
            if ($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            $credentials = $request->only('email', 'password');
            if (!$token = auth()->attempt($credentials)) {
                return new JsonResponse(['error' => 'invalid_credentials'], 401);
            }
            $authUser = auth()->user();
            $userWithToken = MyUser::find($authUser->id)->token; //get user tokens in the table Tokens from user id
            $userWithToken->update([
                'Authorization' => 'Bearer ' .$token,
                'access_token' =>  'Bearer ' .$token,
                'refresh_token' => 'Bearer ' .JWTAuth::fromUser($authUser),
                'expires_in' => auth()->payload()->get('exp')
            ]);
            $jsonWithHeaders = new MyAbstractClass();
            return $jsonWithHeaders -> SendJsonWithHeaders('User has logged in', 200, $userWithToken);

        } catch (\Exception $e) {
            $senderError = new MyAbstractClass();
            return $senderError->SendError($e);
        }
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
//        $expiresFromHeaders = $request->header('expires-in');
//
//        if ($expiresFromHeaders < time()) {
        $userFromModelToken = MyUser::find(auth()->user()->id)->token;
//            if ($request->header('refresh-token') !== $userFromDB->refresh_token) {
//                return new JsonResponse(['message' => 'User hasn`t authorized'], 401);
//            }
        $newAccessToken = JWTAuth::fromUser(auth()->user());
        $userFromModelToken->update([
            'Authorization' => 'Bearer ' .$newAccessToken,
            'access_token' =>  'Bearer ' .$newAccessToken,
            'expires_in' => auth()->payload()->get('exp')
        ]);
//            $jsonWithHeaders = new MyAbstractClass();
//            return new JsonResponse(['pay'=> auth()->payload(), 'token'=> $newAccessToken]);
//            return $jsonWithHeaders -> SendJsonWithHeaders('User has logged in', 200, $userFromDB);
//        }

        return new JsonResponse(auth()->user(),200, ['Authorization' => $userFromModelToken->access_token]);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return new JsonResponse(['message'=> 'Successfully logged out'], 200);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }
}

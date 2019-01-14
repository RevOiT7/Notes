<?php

namespace App\Http\Controllers\Auth;

use App\Models\MyUser;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use JWTAuth;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('api', ['except' => ['login']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|min:5|unique:users',
            'password' => 'required|string|min:5',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request $request
     * @return Controller|JsonResponse $jsonWithHeaders;
     */
    protected function createUser(Request $request)
    {
        $validator = $this->validator($request);
        try {
            if ($validator->fails()) {
                return new JsonResponse($validator->errors(), 400);
            }
            $user = MyUser::create([
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]);
            $userFromRequest = $request->only('email', 'password');
            $token = auth()->attempt($userFromRequest);
            $databaseToken = Token::create([
                'user_id' => $user->id,
                'Authorization' => 'Bearer ' .$token,
                'access_token' => 'Bearer ' .$token,
                'refresh_token' => 'Bearer ' .JWTAuth::fromUser($user),
                'expires_in' => auth()->payload()->get('exp')
            ]);
            $jsonWithHeaders = new Controller();
            return $jsonWithHeaders -> SendJsonWithHeaders('User has created', 201, $databaseToken);
        } catch (\Exception $e) {
            $senderError = new Controller();
            return $senderError->SendError($e);
        }
    }

    public function updateUser(Request $request)
    {
        var_dump($request) ;
        $validator = $this->validator($request);
        try {
            if ($validator->fails()) {
                return new JsonResponse($validator->errors(), 400);
            }
            if (!$user = auth()->user()) {
                return new JsonResponse(['message' => 'User hasn`t authorized'], 401);
            }
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('password'));
            $user->save();
            return new JsonResponse(['message' => 'User has already updated'], 200);
        } catch (\Exception $e) {
            $senderError = new Controller();
            return $senderError->SendError($e);
        }
    }
    public function get($id){

        try{
            $user = MyUser::find($id);

            return new JsonResponse([
                'message'=>'Folder has been sent',

            ], 200);

        }catch (\Exception $e) {
            return  $this->SendError($e);
        }
    }
    /**
     * @return JsonResponse
     */
    public function deleteUser()
    {
        try {
            if (!auth()->user()){
                return new JsonResponse(['message' => 'User hasn`t authorized'], 401);
            }
            MyUser::find(auth()->user()->id)->token->delete();
            MyUser::find(auth()->user()->id)->delete();
            return new JsonResponse(['message'=>'User has deleted'], 200);
        } catch (\Exception $e) {
            $senderError = new Controller();
            return $senderError->SendError($e);
        }
    }

    public function truncated(){

        try {
            echo "_______________________________________________--";
            $user = MyUser::all();

            $user->delete();

            return new JsonResponse(['message'=>'Folder has been truncated'], 200);
        } catch (\Exception $e) {
            return  $this->SendError($e);
        }
    }
}

<?php


namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class MyUser extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table = 'users';
    protected $fillable = [
        'email', 'password',
    ];

    protected $hidden = [
        'password','remember_token',
    ];

    public function setData($email,$password){

        $model = new MyUser();

        $model->email = $email;
        $model->password = $password;
        try{
            $model->save();
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function loadData($email){

        $model = MyUser::where('email', '=', $email)->get();

        if (strlen((string)$model) > 2){return true ;}else{ return false; }
    }

    public function deleteData(){

        $model = MyUser::orderBy('id', 'desc')->first();

        try{
            $model->delete();
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function token()
    {
        return $this->hasOne('App\Models\Token', 'user_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

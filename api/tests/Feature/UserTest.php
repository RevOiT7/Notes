<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\MyUser;

class UserTest extends TestCase
{

//    public function test_Create_Successful()
//    {
//        $response = $this->post('/api/user',
//            [
//                'email' => 'test_1_@mail.com',
//                'password' => '111password'
//            ]);
//
//        $this->assertEquals(201, $response->status());
//    }

//    public function test_Create_EmptyEmail_Error()
//    {
//        $response = $this->post('/api/user',
//            [
//                'email' => '',
//                'password' => '111password'
//            ]);
//
//        $this->assertEquals(400, $response->status());
//    }
//
//    public function test_Create_EmptyPassword_Error()
//    {
//        $response = $this->post('/api/user',
//            [
//                'email' => 'test1_1@mail.com',
//                'password' => ''
//            ]);
//
//        $this->assertEquals(400, $response->status());
//    }
//
//    public function test_Create_EmailExist_Error()
//    {
//        $response = $this->post('/api/user',
//            [
//                'email' => 'test_1_@mail.com',
//                'password' => '111asdgasdgfds'
//            ]);
//
//        $this->assertEquals(400, $response->status());
//    }

    public function test_Update_Successful()
    {
        $user = MyUser::orderBy('created_at', 'desc')->first();
        $id = $user -> id;
        $response = $this->put('/api/auth/user'.$id,
            [
                'email' => 'upd_1_@mail.com',
                'password' => 'upd_1_password'
            ]);

        $this->assertEquals(200, $response->status());
    }
//
//    public function test_Update_WrongEmail_Error()
//    {
//        $user = MyUser::orderBy('created_at', 'desc')->first();
//        $id = $user -> id;
//
//        $response = $this->put('/api/auth/user'.$id,
//            [
//                'email' => 'WRONG',
//                'password' => 'upd_1_@mail.com'
//            ]);
//
//        $this->assertEquals(500, $response->status());
//    }
//
//    public function test_Update_WrongId_Error()
//    {
//        $id = 'wrong';
//        $response = $this->put('/api/auth/user'.$id,
//            [
//                'email' => 'upd_1_@mail.com',
//                'password' => 'WRON'
//            ]);
//
//        $this->assertEquals(500, $response->status());
//    }
//
//    public function test_Get_Successful(){
//
//        $user = MyUser::orderBy('created_at', 'desc')->first();
//        $id = $user -> id;
//        $response = $this->get('/api/user'.$id,
//            [
//                'email' => 'test1@mail.com',
//                'password' => '111password'
//            ]);
//
//        $this->assertEquals(500, $response->status());
//    }
//
//    public function test_Get_WrongId_Error(){
//
//        $id = '';
//        $response = $this->get('/api/user'.$id,
//            [
//
//            ]);
//
//        $this->assertEquals(500, $response->status());
//    }
//    public function test_Delete_Successful()
//    {
//        $user = MyUser::orderBy('created_at', 'desc')->first();
//        $id = $user -> id;
//        $response = $this->delete('/api/user/'.$id);
//
//        $this->assertEquals(200, $response->status());
//    }
//
//    public function test_Delete_WrongId_Error()
//    {
//        $id = 'wrong';
//        $response = $this->delete('/api/user/'.$id);
//
//        $this->assertEquals(500, $response->status());
//    }

//    public function truncated(){
//        echo "_______________________________________________--";
//        $response = $this->delete('/api/usr');
//
//        $this->assertEquals(201, $response->status());
//    }
}



//FOR STARTING TESTS USE --- vendor/bin/phpunit !!!

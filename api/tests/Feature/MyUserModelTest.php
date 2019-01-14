<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 28.11.18
 * Time: 16:36
 */

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\MyUser;

class MyUserModelTest extends TestCase
{
    public function test_Save_Successful(){

        $email = 'gorge@gmail.com';
        $password = 'fromthejungle';

        $model = new MyUser();
        $this->assertTrue ($model->setData($email, $password));
    }

    public function test_Save_EmailExist_Errorl(){

        $email = 'gorge@gmail.com';
        $password = 'fromthejungle';

        $model = new MyUser();
        $this->assertTrue (!$model->setData($email, $password));
    }

    public function test_Load_Successful(){

        $email = 'gorge@gmail.com';
        $model = new MyUser();
        $this->assertTrue($model->loadData($email));
    }

    public function test_Load_WrongTitle_Error(){

        $title = 'WRONG_ID';
        $model = new MyUser();
        $this->assertTrue(!$model->loadData($title));
    }

    public function test_Delete_Successful(){

      $model = new MyUser();
      $this->assertTrue($model->deleteData());
    }

}
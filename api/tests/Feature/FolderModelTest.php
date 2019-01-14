<?php


namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use App\Models\Folder;

class FolderModelTest extends TestCase
{

    public function test_Save_Successful(){

        $parent_id = 1;
        $title = 'Save_1';

        $model = new Folder();
        $this->assertTrue ($model->setData($parent_id, $title));
    }

    public function test_Save_ExistTitle_Error(){

        $parent_id = 1;
        $title = 'Save_1';

        $model = new Folder();
        $this->assertTrue (!$model->setData($parent_id, $title));
    }

    public function test_Load_Successful(){

        $title = 'Save_1';
        $model = new Folder();
        $this->assertTrue($model->loadData($title));
    }

    public function test_Load_WrongTitle_Error(){

        $title = 'Save_';
        $model = new Folder();
        $this->assertTrue(!$model->loadData($title));
    }

    public function test_Delete_Successful(){

      $model = new Folder();
      $this->assertTrue($model->deleteData());

    }

}

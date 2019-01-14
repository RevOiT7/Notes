<?php

namespace Tests\Feature;

use App\Http\Controllers\FolderController;
use Tests\TestCase;
use App\Models\Folder;

class FolderTest extends TestCase
{
    public function test_Create_Successful(){

        $id = 1;
        $response = $this->post('/api/auth/folder/'.$id,
            [
                'title' => 'Folder_1',
            ]);
        //var_dump($response->getContent());
        $this->assertEquals(201, $response->status());
    }
    public function test_Create_EmptyTitle_Error(){

        $id = 1;

        $response = $this->post('/api/auth/folder/'.$id,
            [
                'title' => '',
            ]);
        //var_dump($response->getContent());
        $this->assertEquals(500, $response->status());

    }

    public function test_Create_AlreadyExist_Error(){

        $id = 1;

        $response = $this->post('/api/auth/folder/'.$id,
            [
                'title' => 'Folder_1',
            ]);
        //var_dump($response->getContent());
        $this->assertEquals(500, $response->status());
    }

    public function test_Create_WrongId_Error(){

        $id ='wrong';
        $response = $this->post('/api/auth/folder/'.$id,
            [
                'title' => 'Folder_1',
            ]);
        //var_dump($response->getContent());
        $this->assertEquals(500, $response->status());
    }

    public function test_Update_Successful()
    {
        $folder = Folder::orderBy('created_at', 'desc')->first();
        $id = $folder -> id;

        $response = $this->put('/api/auth/folder/'.$id,
            [
                'title' => 'Upd_1 '
            ]);

        //var_dump($response->Content());
        $this->assertEquals(200, $response->status());
    }
    public function test_Update_EmptyTitle_Error()
    {
        $folder = Folder::orderBy('created_at', 'desc')->first();
        $id = $folder -> id;

        $response = $this->put('/api/auth/folder/'.$id,
            [
                'title' => ''
            ]);

        //var_dump($response->Content());
        $this->assertEquals(500, $response->status());
    }
    public function test_Update_TitleExist_Error()
    {

        $id = "WRONG_ID";

        $response = $this->put('/api/auth/folder/'.$id,
            [
                'title' => 'Upd_1'
            ]);

        //var_dump($response->Content());
        $this->assertEquals(500, $response->status());
    }

    public function test_Get_Successful(){

        $folder = Folder::orderBy('created_at', 'desc')->first();
        $id = $folder -> id;
        $response = $this->get('/api/auth/folder/'.$id,
            [

            ]);

        //var_dump($response->getContent());
        $this->assertEquals(200, $response->status());
    }
    public function test_Get_WrongId_Error(){
        $id = "wrong";
        $response = $this->get('/api/auth/folder/'.$id,
            [

            ]);

        //var_dump($response->getContent());
        $this->assertEquals(500, $response->status());
    }

    public function test_Delete_Successful()
    {
        $folder = Folder::orderBy('created_at', 'desc')->first();
        $id = $folder -> id;
        $response = $this->delete('/api/auth/folder/'.$id);

        //var_dump($response->getContent());
        $this->assertEquals(200, $response->status());
    }

    public function test_Delete_WrongId_Error()
    {
        $id = 'WRONG_ID';
        $response = $this->delete('/api/auth/folder/'.$id);

        //var_dump($response->getContent());
        $this->assertEquals(500, $response->status());
    }


}
//FOR STARTING TESTS USE --- vendor/bin/phpunit !!!

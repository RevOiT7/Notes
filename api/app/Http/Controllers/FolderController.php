<?php

namespace App\Http\Controllers;

use App\Models\Folder;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FolderController extends \App\Http\Controllers\Controller
{

    public function create(Request $request, $parent_id){

        try {
            $folder = new Folder();
            $folder->title = $request->input('title');
            $folder->parent_id = $parent_id ?? null;

            $folder->save();

            return new JsonResponse(['id' => $folder->id], 201);
        } catch (\Exception $e) {
            return $this->SendError($e);
        }
    }

    public function update(Request $request, $id){

        try {
            $folder = Folder::find($id);
            $folder->title = $request->title;

            $folder->save();

            return new JsonResponse($folder->serialize(), 200);
        } catch (\Exception $e) {
            return  $this->SendError($e);
        }
    }

    public function get($id){

        try{
            $folder = Folder::find($id);

            $subfolders = [];
            foreach ($folder->subfolders as $subfolder) {
                $subfolders[] = $subfolder->serialize();
            }

            return new JsonResponse([
                'message'=>'Folder has been sent',
                'subfolders' => $subfolders,
                'folderData' => $folder->serialize()
            ], 200);

        }catch (\Exception $e) {
            return  $this->SendError($e);
        }
    }

    public function deleted($id){

        try {
            $folder = Folder::find($id);

            $folder->delete();

            return new JsonResponse(['message'=>'Folder has been deleted'], 200);
        } catch (\Exception $e) {
            return  $this->SendError($e);
        }
    }

    public function truncated(){

        try {
              $folder = Folder::orderBy('created_at', 'desc')->first();

              $folder->delete();
//            $folder->truncate(); //delete all records on DB

            return new JsonResponse(['message'=>'Folder has been truncated'], 200);
        } catch (\Exception $e) {
            return  $this->SendError($e);
        }
    }

}

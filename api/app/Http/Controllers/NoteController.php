<?php

namespace App\Http\Controllers;

use App\Http\MyExceptions\NoteNotFoundException;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Exception;
use \App\Http\MyExceptions\UserNotFoundException;

class NoteController extends \App\Http\Controllers\Controller
{

    public function create(Request $request, $parent_id)
    {
        try {
            $note = new Note();
            $note->caption = $request->input('caption');
            $note->text = $request->input('text');
            $note->parent_id = $parent_id ?? null;

            $note->save();
            return new JsonResponse(['message' => 'Note has created'], 201);
        } catch (\Exception $e) {
            return $this->SendError($e);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $note = Note::find($id);

            $note->caption = $request->input('caption');
            $note->text = $request->input('text');
            $note->save();
            return new JsonResponse(['message'=>'Note has updated'], 200);
        } catch (\Exception $e) {
            return  $this->SendError($e);
        }
        //Redirect::to('/notes');
    }

    public function get($id){

        try{
            $note = Note::find($id);

            $subnotes = [];
            foreach ($note->notes as $notate) {
                $subnotes[] = $notate->serialize();
            }

            return new JsonResponse([
                'message'=>'Folder has been sent',
                'subnotes' => $subnotes,
                'note' => $note->serialize()
            ], 200);

        }catch (\Exception $e) {
            return  $this->SendError($e);
        }
    }

    public function delete($id)
    {
        try {
            $note = Note::find($id);

            $note->delete();
            return new JsonResponse(['message'=>'Note has deleted'], 200);
        } catch (\Exception $e) {
            return  $this->SendError($e);
        }
        //Redirect::to('/notes');
    }

    public function truncated(){

        try {
            $note = Note::orderBy('created_at', 'desc')->first();

            $note->delete();
           // $note->truncate(); //delete all records on DB

            return new JsonResponse(['message'=>'Note has been truncated'], 200);
        } catch (\Exception $e) {
            return  $this->SendError($e);
        }
    }
}

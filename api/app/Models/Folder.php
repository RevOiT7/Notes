<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = 'folders';
    protected $fillable = [
         'parent_id', 'title'
    ];

    public function setData($parent_id,$title){

        $model = new Folder();

        $model->title = $title;
        $model->parent_id = $parent_id;
        try{
           $model->save();
           return true;
        }catch (\Exception $e){
           return false;
        }
    }

    public function loadData($title){

        $model = Folder::where('title', '=', $title)->get();

        if ( strlen((string)$model) > 2){return true ;}else{ return false; }
    }

    public function deleteData(){

        $model = Folder::orderBy('id', 'desc')->first();

        try{
            $model->delete();
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function subfolders(){
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function serialize() {
        return [
            'title' => $this->title,
            'id' => $this->id,
            'parent_id' => $this->parent_id,
        ];
    }

}

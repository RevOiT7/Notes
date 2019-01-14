<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Jenssegers\Mongodb\Schema\Blueprint;
//use Illuminate\Database\Schema\Blueprint;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->create('notes', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->unique('caption');
            $collection->longText('text');
            $collection->string('parent_id')->nullable();
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->table('notes', function (Blueprint $collection) {
            $collection->dropIfExists();
        });

            //Schema::dropIfExists('notes');
    }
}

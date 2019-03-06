<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->comment('0 - вход; 1 - изход');
            $table->string('name');
            $table->string('family');
            $table->integer('user_id');
            $table->index('user_id');
            $table->integer('grade_id')->default(0);
            $table->index('grade_id');
            $table->integer('school_id');
            $table->index('school_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}

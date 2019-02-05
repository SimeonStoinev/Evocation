<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id');
            $table->index('school_id');
            $table->integer('grade_id');
            $table->index('grade_id');
            $table->integer('curriculum_id');
            $table->index('curriculum_id');
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
        Schema::dropIfExists('classbooks');
    }
}

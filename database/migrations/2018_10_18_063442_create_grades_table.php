<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->json('student_ids')->nullable();
            $table->integer('classteacher_id')->default(0);
            $table->index('classteacher_id');
            $table->integer('school_id')->default(0);
            $table->index('school_id');
            $table->integer('curriculum_id')->default(0);
            $table->index('curriculum_id');
            $table->tinyInteger('shift')->default(1);
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
        Schema::dropIfExists('grades');
    }
}

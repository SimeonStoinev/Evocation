<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckinListenersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkin_listeners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id');
            $table->index('teacher_id');
            $table->integer('grade_id');
            $table->index('grade_id');
            $table->integer('lesson_id');
            $table->index('lesson_id');
            $table->json('student_ids');
            $table->json('not_checked')->nullable();
            $table->boolean('opened');
            $table->char('time', 10)->nullable();
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
        Schema::dropIfExists('checkin_listeners');
    }
}

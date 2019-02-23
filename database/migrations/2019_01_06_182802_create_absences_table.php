<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->index('user_id');
            $table->integer('listener_id');
            $table->index('listener_id');
            $table->integer('grade_id');
            $table->index('grade_id');
            $table->integer('school_id');
            $table->index('school_id');
            $table->boolean('late')->default(false);
            $table->boolean('excused')->default(false);
            $table->boolean('kicked')->default(false);
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
        Schema::dropIfExists('absences');
    }
}

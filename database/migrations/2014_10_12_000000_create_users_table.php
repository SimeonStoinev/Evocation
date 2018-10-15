<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('family');
            $table->string('email')->unique();
            $table->string('password');
            $table->char('rank', 15)->comment('admin, headmaster, subheadmaster, teacher, student, parent');
            $table->index('rank');
            $table->boolean('is_classteacher')->default(0)->comment('Applies only to teachers which are leading a class.');
            $table->integer('grade_id')->default(0);
            $table->index('grade_id');
            $table->integer('school_id')->default(0);
            $table->index('school_id');
            $table->integer('family_link_id')->default(0)->comment('Applies only to parents and students.');
            $table->index('family_link_id');
            $table->boolean('info_downloaded')->default(0)->comment('GDPR');
            $table->boolean('verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

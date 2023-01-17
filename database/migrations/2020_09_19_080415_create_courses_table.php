<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('topic');
            $table->text('description');
            $table->string('uniqueLink', 100)->unique();
            $table->string('uniqueCode', 20)->unique();
            $table->unsignedBigInteger('leader_id');
            $table->timestamps();

            $table->index('leader_id', 'course_user_idx');

            $table->foreign('leader_id', 'course_user_fk')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};

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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');

            $table->timestamps();

            $table->index('course_id', 'invitation_course_idx');
            $table->index('user_id', 'invitation_user_idx');
            $table->foreign('course_id', 'invitation_course_fk')->on('courses')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id', 'invitation_user_fk')->on('users')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
};

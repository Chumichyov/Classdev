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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('theme_id')->nullable();
            $table->unsignedBigInteger('type_id');
            $table->date('deadline')->nullable();
            $table->timestamps();

            $table->index('course_id', 'task_course_idx');
            $table->index('theme_id', 'course_theme_idx');
            $table->index('type_id', 'course_type_idx');

            $table->foreign('course_id', 'task_course_fk')->on('courses')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('theme_id', 'course_theme_fk')->on('themes')->references('id');
            $table->foreign('type_id', 'course_type_fk')->on('types')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};

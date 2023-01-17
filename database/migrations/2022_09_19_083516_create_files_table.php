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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('completed_id')->nullable();
            $table->unsignedBigInteger('task_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('extension');
            $table->text('originalName');
            $table->text('dataPath');
            $table->timestamps();

            $table->index('completed_id', 'file_completed_idx');
            $table->index('task_id', 'file_task_idx');
            $table->index('user_id', 'file_user_idx');

            $table->foreign('completed_id', 'file_completed_fk')->on('completed')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('task_id', 'file_task_fk')->on('tasks')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id', 'file_user_fk')->on('users')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('completed_data_paths');
    }
};

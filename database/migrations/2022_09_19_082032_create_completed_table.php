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
        Schema::create('completed', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('option_id')->default(1);

            $table->unsignedInteger('grade')->nullable();

            $table->timestamps();

            $table->index('user_id', 'completed_user_idx');
            $table->index('task_id', 'completed_task_idx');
            $table->index('option_id', 'file_option_idx');

            $table->foreign('user_id', 'completed_user_fk')->on('users')->references('id');
            $table->foreign('task_id', 'completed_task_fk')->on('tasks')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('option_id', 'file_option_fk')->on('options')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('completeds');
    }
};

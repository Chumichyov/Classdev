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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('file_id');
            $table->unsignedBigInteger('type_id');
            $table->integer('first');
            $table->integer('last');
            $table->text('description');

            $table->timestamps();
            $table->index('file_id', 'review_file_idx');
            $table->foreign('file_id', 'review_file_fk')->on('files')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->index('type_id', 'review_type_idx');
            $table->foreign('type_id', 'review_type_fk')->on('type_reviews')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};

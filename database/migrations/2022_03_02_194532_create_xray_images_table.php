<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXrayImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xray_images', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->text('note')->nullable();
            $table->String('file',1000);
            $table->String('file_type');
            $table->Integer('file_size');
            $table->unsignedBigInteger('user_id');
            $table->String('result')->nullable();
            $table->String('comment')->nullable();
            $table->text('log')->nullable();
            $table->foreign('user_id')->on('users')->references('id');
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
        Schema::dropIfExists('xray_images');
    }
}

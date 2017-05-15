<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreindshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freindships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requester')->unsigned();
            $table->foreign('requester')->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_requested')->unsigned();
            $table->foreign('user_requested')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('status');
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
        Schema::dropIfExists('freindships');
    }
}

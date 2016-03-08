<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRafflesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raffles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255)->default('');
            $table->text('body')->default('');
            $table->integer('start')->default(0);
            $table->integer('end')->default(0);
            $table->boolean('imageReq')->default(0);
            $table->boolean('legalAgeReq')->default(0);
            $table->boolean('sendPdf')->default(0);
            $table->boolean('endState')->default(1);
            $table->boolean('maxpState')->default(0);
            $table->integer('maxp')->default(0);
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
        Schema::drop('raffles');
    }
}

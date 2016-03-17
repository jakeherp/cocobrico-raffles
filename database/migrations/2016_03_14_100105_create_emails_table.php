<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255)->default('noreply@cocobrico.com');
            $table->string('from', 255)->default('Cocobrico');
            $table->string('subject',255)->default('');
            $table->text('body')->default('');
            $table->string('description',100)->default('');
            $table->string('slug')->default('');
            $table->boolean('standard')->default(0);
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
        Schema::drop('emails');
    }
}

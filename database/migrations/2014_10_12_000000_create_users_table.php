<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255)->unique();
            $table->string('firstname', 255)->default('');
            $table->string('lastname', 255)->default('');
            $table->string('password', 60)->default('');
            $table->string('register_token', 255)->default('');
            $table->integer('birthday')->default(0)->nullable();
            $table->integer('gender')->default(0);
            $table->boolean('active')->default(1);
            $table->boolean('aNewsletter')->default(0);
            $table->boolean('aRaffles')->default(1);
            $table->boolean('aMessages')->default(1);
            $table->text('remark')->default('');
            $table->integer('registered_at')->default(0);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}

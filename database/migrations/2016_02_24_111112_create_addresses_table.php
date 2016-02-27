<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('firstname', 255)->default('');
            $table->string('lastname', 255)->default('');
            $table->string('address1', 255)->default('');
            $table->string('address2', 255)->default('');
            $table->string('zipcode', 255)->default('');
            $table->string('city', 255)->default('');
            $table->integer('country_id')->default(0);
            $table->string('phone', 255)->default('');
            $table->string('fax', 255)->default('');
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
        Schema::drop('addresses');
    }
}

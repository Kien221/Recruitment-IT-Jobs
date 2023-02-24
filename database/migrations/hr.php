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
        Schema::create('hrs', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('avatar')->default('user.png');
            $table->string('email',100);
            $table->string('password',30);
            $table->string('phoneNumber',15)->nullable();
            $table->string('address',255)->nullable();
            $table->integer('status')->default(0);
            $table->string('token',15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrs');
    }
};

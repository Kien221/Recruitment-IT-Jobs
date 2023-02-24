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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('avatar')->nullable();
            $table->string('email',100);
            $table->string('password',30);
            $table->string('phoneNumber',15)->nullable();
            $table->string('address',255)->nullable();
            $table->foreignId('city_id')->constrained('cities')->nullable();
            $table->string('links')->nullable();
            $table->longText('introduce_yourself')->nullable();
            $table->longText('study_degree')->nullable();
            $table->longText('experience')->nullable();
            $table->longText('hobby')->nullable();
            $table->string('certificate')->nullable();
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
        Schema::dropIfExists('applicants');
    }
};

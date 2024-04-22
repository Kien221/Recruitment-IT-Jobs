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
        Schema::create('chatting', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms_chat')->nullable();
            $table->string('text_message');
            // from 0 : applicant, 1 : hr
            $table->integer('from');
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
        //
    }
};

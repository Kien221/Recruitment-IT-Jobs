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
        Schema::create('level_account', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hr_id')->constrained('hrs')->nullable();
            $table->foreignId('service_id')->constrained('services')->nullable();
            $table->smallInteger('used_views');
            $table->smallInteger('used_search');
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

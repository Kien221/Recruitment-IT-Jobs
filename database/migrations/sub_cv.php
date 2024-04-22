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
        Schema::create('sub_cv', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->nullable()->constrained('applicants');
            $table->string('typeCV',20)->nullable();
            $table->smallInteger('exp_year_work')->nullable();
            $table->string('position_want_to_apply',50)->nullable();
            $table->string('languages_want_to_apply',50)->nullable();
            $table->string('city_want_to_work',20)->nullable();
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

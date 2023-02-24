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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->string('slug',255);
            $table->string('languages',255);
            $table->foreignId('company_id')->nullable()->constrained('companies');
            $table->string('city',20);
            $table->string('district',20);
            $table->string('position',100);
            $table->string('work_type',30);
            $table->string('min_salary',20);
            $table->string('max_salary',20);
            $table->string('unit_money',5);
            $table->integer('number_of_recruitment');
            $table->date('expired_post');
            $table->longText('description');
            $table->longText('requirement');
            $table->longText('benefit');
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
        Schema::dropIfExists('posts');
    }
};

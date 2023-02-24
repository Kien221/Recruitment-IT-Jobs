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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hr_id')->nullable()->constrained('hrs');
            $table->String('name',50);
            $table->string('logo',255)->nullable();
            $table->string('email',50)->nullable();
            $table->string('phone',50)->nullable();
            $table->string('website',255)->nullable();
            $table->string('tax_code',20)->nullable();
            $table->string('address',255)->nullable();
            $table->string('number_of_employees',50)->nullable();
            $table->string('industry',50)->nullable();
            $table->longText('description_company',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};

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
        Schema::create('apply_cvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->nullable()->constrained('posts');
            $table->foreignId('applicant_id')->nullable()->constrained('applicants');
            $table->string('type_cv',20);
            $table->string('file_cv',255)->nullable();
            $table->string('status')->default(0);
            $table->string('brief_introduce',255)->nullable();
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

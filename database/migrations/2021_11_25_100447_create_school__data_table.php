<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school__data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('motto');
            $table->string('email');
            $table->string('phone');
            $table->string('alt_phone');
            $table->string('pobox');
            $table->string('town');
            $table->string('logo');
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
        Schema::dropIfExists('school__data');
    }
}

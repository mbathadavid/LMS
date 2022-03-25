<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('Fname');
            $table->string('Sname')->nullable();
            $table->string('Lname');
            $table->string('Active')->default('Active');
            $table->string('Parent/Guardian')->nullable();
            $table->string('Students');
            $table->string('Phone');
            $table->string('AltPhone')->nullable();
            $table->string('Email')->nullable();
            $table->string('Gender')->nullable();
            $table->string('Paasword')->default('password123');
            $table->string('Profile')->default('avatar.png');
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
        Schema::dropIfExists('parents');
    }
}

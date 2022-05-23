<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->string('prefix');
            $table->string('nom');
            $table->string('img');
            $table->string('race');
            $table->boolean('sexe');
            $table->unsignedBigInteger('');

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
        Schema::dropIfExists('personnage');
    }
}

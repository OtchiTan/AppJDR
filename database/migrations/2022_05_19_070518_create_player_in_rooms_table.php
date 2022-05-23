<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerInRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_in_rooms', function (Blueprint $table) {
            $table->string('roomID');
            $table->unsignedBigInteger('playerID')->unique();

            $table->foreign('roomID')->references('id')->on('rooms');
            $table->foreign('playerID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_in_rooms');
    }
}

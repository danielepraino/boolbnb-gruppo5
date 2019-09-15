<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description');
            $table->integer('room');
            $table->integer('bed');
            $table->integer('bathroom');
            $table->integer('sm');
            $table->string('address');
            $table->string('image')->nullable();
            $table->boolean('visible');
            $table->decimal('lon', 10, 6);
            $table->decimal('lat', 10, 6);
            $table->integer('price');
            $table->integer('user_id');
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
        Schema::dropIfExists('flats');
    }
}

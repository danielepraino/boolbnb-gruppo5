<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('wifi')->default(0);
            $table->boolean('parking')->default(0);
            $table->boolean('pool')->default(0);
            $table->boolean('concierge')->default(0);
            $table->boolean('sauna')->default(0);
            $table->boolean('sea_view')->default(0);
            $table->integer('flat_id');
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
        Schema::dropIfExists('services');
    }
}

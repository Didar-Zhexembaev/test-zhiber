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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('from');
            $table->unsignedBigInteger('to');
            $table->unsignedBigInteger('transport_type');
            $table->unsignedBigInteger('departure_type');
            $table->unsignedBigInteger('weight');
            $table->dateTime('date_time');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('from')->references('id')->on('cities');
            $table->foreign('to')->references('id')->on('cities');
            $table->foreign('transport_type')->references('id')->on('transports');
            $table->foreign('departure_type')->references('id')->on('departure_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
};

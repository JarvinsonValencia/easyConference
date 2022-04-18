<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('document');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->unsignedBigInteger('venue_id')->nullable();
            $table->timestamps();

            $table->foreign('venue_id')->references('id')->on('venues');
            //$table->foreignId('venue_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}

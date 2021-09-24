<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');

            $table->foreign('travel_id')->references('id')->
            on('travels')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('itinerary_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('customer');
            $table->string('contact');
            $table->integer('number');
            $table->integer('total');
            $table->string('tarification');
            $table->boolean('ispaid')->default(0);
            $table->boolean('canceled')->default(0);
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
        Schema::dropIfExists('reservations');
    }
}

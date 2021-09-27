<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanceledPaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canceled_paiements', function (Blueprint $table) {
            $table->id();
            $table->integer('montant')->default(0);
            $table->string('mode')->default('caisse');
            $table->foreignId('reservation_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('motif')->default('sans motif');
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
        Schema::dropIfExists('canceled_paiements');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->integer('montant')->default(0);
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('commentaire')->default('');
            $table->string('etat')->default('en attente');
            $table->boolean('canceled')->default(0);
            $table->foreignId('counter_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('depenses');
    }
}

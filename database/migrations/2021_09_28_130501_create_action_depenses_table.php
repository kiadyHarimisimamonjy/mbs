<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_depenses', function (Blueprint $table) {
            $table->id();
            $table->integer('montant')->default(0);
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('depense_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('commentaire')->default('');
            $table->string('action')->default('en attente');
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
        Schema::dropIfExists('action_depenses');
    }
}

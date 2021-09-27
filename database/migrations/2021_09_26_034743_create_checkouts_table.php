<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('openby');
            $table->foreign('openby')->references('id')->
            on('users')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->unsignedBigInteger('closedby');
            $table->foreign('closedby')->references('id')->
            on('users')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('counter_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('montant')->default(0);
            $table->integer('constate')->default(0);
            $table->integer('calcule')->default(0);
            $table->integer('decalage')->default(0);
            $table->integer('paie')->default(0);
            $table->integer('depense')->default(0);
            $table->integer('annulation')->default(0);
            $table->string('debutcommentaire')->default('');
            $table->string('fincommentaire')->default('');
            $table->string('mode')->default('caisse');
            $table->boolean('isclosed')->default(0);

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
        Schema::dropIfExists('checkouts');
    }
}

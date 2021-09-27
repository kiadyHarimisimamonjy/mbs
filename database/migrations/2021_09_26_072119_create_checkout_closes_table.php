<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutClosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_closes', function (Blueprint $table) {
            $table->id();
            $table->integer('constate')->default(0);
            $table->integer('calcule')->default(0);
            $table->integer('decalage')->default(0);
            $table->integer('paie')->default(0);
            $table->integer('depense')->default(0);
            $table->integer('annulation')->default(0);
            $table->string('mode')->default('caisse');
            $table->foreignId('checkout_open_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('commentaire')->default('');
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
        Schema::dropIfExists('checkout_closes');
    }
}

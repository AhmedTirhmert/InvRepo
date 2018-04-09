<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande', function (Blueprint $table) {
            $table->integer('numero_com')->primary();
            $table->integer('code_c_for');
            $table->integer('id_etat_for');
            $table->foreign('code_c_for')->references('code_c')->on('client');
            $table->foreign('id_etat_for')->references('id_etet')->on('etat_commande');

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
        Schema::dropIfExists('commande');
    }
}

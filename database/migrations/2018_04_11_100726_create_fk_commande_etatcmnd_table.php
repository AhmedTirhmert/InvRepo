<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkCommandeEtatcmndTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commande', function (Blueprint $table) {
           $table->foreign('id_etat')->references('id_etat')->on('etat_commande');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropconstraint('fk_commande_etatcmnd');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkCommandeUtilisateurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commande', function (Blueprint $table) {
            $table->foreign('code_utilisateur')->references('code_utilisateur')->on('utilisateur');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropconstraint('fk_commande_client');
    }
}

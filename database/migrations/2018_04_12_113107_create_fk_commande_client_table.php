<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkCommandeClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commande', function (Blueprint $table) {
            $table->foreign('id_client')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *dropconstraint
     * @return void
     */
    public function down()
    {
        Schema::dropconstraint('fk_commande_admins');
    }
}

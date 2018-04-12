<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkCommandeAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commande', function (Blueprint $table) {
            $table->foreign('id_admin')->references('id_admin')->on('admins');
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

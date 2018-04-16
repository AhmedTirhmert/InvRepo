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
            $table->increments('numero_cmnd');
            $table->unsignedInteger('id_client');
            $table->unsignedInteger('id_etat');
            $table->unsignedInteger('id_admin');
            $table->date('date_effectue');
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

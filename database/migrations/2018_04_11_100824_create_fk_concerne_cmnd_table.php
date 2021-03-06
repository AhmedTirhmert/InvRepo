<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkConcerneCmndTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('concerne', function (Blueprint $table) {
            $table->foreign('numero_cmnd')->references('numero_cmnd')->on('commande');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropconstraint('fk_concerne_cmnd');
    }
}

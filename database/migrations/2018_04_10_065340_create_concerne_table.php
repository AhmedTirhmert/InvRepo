<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcerneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concerne', function (Blueprint $table) {
            $table->string('ref_p_for',8);
            $table->integer('numero_com_for');
            $table->foreign('ref_p_for')->references('ref')->on('produit');
            $table->foreign('numero_com_for')->references('numero_com')->on('commande');
            $table->primary(['numero_com_for', 'ref_p_for']);
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
        Schema::dropIfExists('concerne');
    }
}

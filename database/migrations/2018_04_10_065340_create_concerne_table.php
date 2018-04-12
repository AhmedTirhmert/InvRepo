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

            $table->unsignedInteger('code_produit');
            $table->unsignedInteger('numero_cmnd');
            $table->unsignedInteger('qte_cmnd');
            $table->primary(['code_produit', 'numero_cmnd']);
            
            
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

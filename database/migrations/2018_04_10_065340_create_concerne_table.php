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

            $table->engine = 'InnoDB';
            $table->string('fk_concerne_produit',8);
            $table->unsignedInteger('fk_concerne_cmnd');
            $table->primary(['fk_concerne_cmnd', 'fk_concerne_produit']);
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFournirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournir', function (Blueprint $table) {
           $table->engine = 'InnoDB';
            $table->string('fk_fournir_produit',8);
            $table->unsignedInteger('fk_fournir_fournisseur');
            
            
            $table->primary(['fk_fournir_produit', 'fk_fournir_fournisseur']);
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
        Schema::dropIfExists('fournir');
    }
}

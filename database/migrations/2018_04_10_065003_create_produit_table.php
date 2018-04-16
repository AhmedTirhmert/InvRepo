<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit', function (Blueprint $table) {
            $table->increments('code_produit');
            $table->string('Reference',8)->unique;
            $table->unsignedInteger('code_fournisseur');
            $table->unsignedInteger('code_categorie');
            $table->string('designation');
            $table->double('prix_unitaire');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit');
    }
}

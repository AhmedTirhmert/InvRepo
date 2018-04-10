<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFournisseurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_fournisseur', function (Blueprint $table) {
            $table->char('Code_F',10);
            $table->string('Password');
            $table->string('Prenom');
            $table->string('Nom');
            $table->string('Adresse');
            $table->string('Telephone');
            $table->string('Email');
            $table->primary('Code_F');
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
        Schema::dropIfExists('_fournisseur');
    }
}

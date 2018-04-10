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
        Schema::create('fournisseur', function (Blueprint $table) {
<<<<<<< HEAD:database/migrations/2018_04_10_064847_create_fournisseur_table.php
            $table->integer('code_f')->primary();
            $table->string('nom',10);
            $table->string('prenom',10);
            $table->string('Adresse',14);
            $table->string('telephone',14)->unique();
            $table->string('email',20)->unique();

=======
            $table->integer('Code_F')->autoIncrement();
            $table->string('Prenom');
            $table->string('Nom');
            $table->string('Adresse');
            $table->string('Telephone')->unique();
            $table->string('Email')->unique();
>>>>>>> 6697e12af02141b81109ea3bac2367a6a36c97b4:database/migrations/2018_04_09_231122_create__fournisseur_table.php
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
        Schema::dropIfExists('fournisseur');
    }
}

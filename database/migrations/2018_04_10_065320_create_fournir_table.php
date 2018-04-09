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
            $table->string('ref_prd_for',8);
            $table->integer('code_f_for');
            $table->foreign('code_f_for')->references('code_f')->on('fournisseur');
            $table->foreign('ref_prd_for')->references('ref')->on('produit');
            $table->primary(['ref_prd_for', 'code_f_for']);
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

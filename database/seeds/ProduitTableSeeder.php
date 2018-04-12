<?php

use Illuminate\Database\Seeder;

class ProduitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
    		$limit = 50;

    		for ($i=0; $i < $limit; $i++) { 
    			DB::table('produit')->insert(
    				[
    				
    				'ref'=>$faker->ean8,
    				'fk_produit_categorie'=>$faker->numberBetween(1,4),
    				'designation'=>$faker->text($maxNbChars = 20),
    				'prix_unitaire'=>$faker->randomFloat(),
    				'created_at'=>$faker->dateTime,
    				'updated_at'=>$faker->dateTime,
    				]
    			);
    		}    }
}

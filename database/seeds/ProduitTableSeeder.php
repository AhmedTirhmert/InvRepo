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
    				
    				'reference'=>$faker->ean8,
    				'code_categorie'=>$faker->numberBetween(1,4),
                    'code_fournisseur'=>$faker->numberBetween(1,50),
    				'designation'=>$faker->text($maxNbChars = 20),
    				'prix_unitaire'=>$faker->randomFloat(),
    				'quantite'=>$faker->numberBetween(0,200),
    				]
    			);
    		}   
            }
}

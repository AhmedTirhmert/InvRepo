<?php

use Illuminate\Database\Seeder;

class CategorieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$cat = ['Consommable','Materiel Informatique','Equipment Bureau','Papier'];

        $faker = Faker\Factory::create();
    		$limit = 4;

    		for ($i=0; $i < $limit; $i++) { 
    			DB::table('categorie')->insert(
    				[
    				
    				
    				'libelle'=>$cat[$faker->unique()->numberBetween(0,3)],
    				'created_at'=>$faker->dateTime,
    				'updated_at'=>$faker->dateTime,
    				]
    			);
    		}    }
}

<?php

use Illuminate\Database\Seeder;

class ConcerneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $faker = Faker\Factory::create();
    		$limit = 25;
    		

    		for ($i=0; $i < $limit; $i++) { 
    			DB::table('concerne')->insert(
    				[
    				
    				
    				'code_produit'=>$faker->numberBetween(1,50),
    				'numero_cmnd'=>$faker->numberBetween(1,50),
    				'qte_cmnd'=>$faker->numberBetween(1,20),
    				
    				]

    			);
    		}  
    }
}

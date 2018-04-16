<?php

use Illuminate\Database\Seeder;

class CommandeTableSeeder extends Seeder
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
    			DB::table('commande')->insert(
    				[
    				
    				
    				'id_etat'=>$faker->numberBetween(1,2),
    				'id_admin'=>$faker->numberBetween(1,2),
            'id_client'=>$faker->numberBetween(3,25),
    				'date_effectue'=>$faker->date,
    				
    				]
    			);
    		}   
            }
}

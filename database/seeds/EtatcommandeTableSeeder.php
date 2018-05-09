<?php

use Illuminate\Database\Seeder;

class EtatcommandeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    
         	$etat = ['confirmé','En attent'];

        $faker = Faker\Factory::create();
    		$limit = 2;

    		for ($i=0; $i < $limit; $i++) { 
    			DB::table('etat_commande')->insert(
    				[
    				
    				
    				'etat'=>$etat[$i],
    				
    				]
    			);
    		}   
    }
}

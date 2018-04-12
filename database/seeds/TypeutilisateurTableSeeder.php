<?php

use Illuminate\Database\Seeder;

class TypeutilisateurTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           	$type_utilisateur = ['Client','Fournisseur'];

        $faker = Faker\Factory::create();
    		$limit = 2;

    		for ($i=0; $i < $limit; $i++) { 
    			DB::table('type_utilisateur')->insert(
    				[
    				
    				
    				'role'=>$type_utilisateur[$faker->unique()->numberBetween(0,1)],
    				
    				]
    			);
    		}   


    }
}

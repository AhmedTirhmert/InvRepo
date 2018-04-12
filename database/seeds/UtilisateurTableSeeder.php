<?php

use Illuminate\Database\Seeder;

class UtilisateurTableSeeder extends Seeder
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
    			DB::table('utilisateur')->insert(
    				[
    				'name'=>$faker->name,
                    'id_type'=>$faker->numberBetween(1,2),
    				'email'=>$faker->email,
    				'telephone'=>$faker->phoneNumber,
    				'adresse'=>$faker->address,
    				]
    			);
    		}
    }
}

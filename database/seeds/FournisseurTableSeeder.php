<?php

use Illuminate\Database\Seeder;

class FournisseurTableSeeder extends Seeder
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
    			DB::table('fournisseur')->insert(
    				[
    				'name'=>$faker->name,
    				'email'=>$faker->email,
    				'telephone'=>$faker->phoneNumber,
    				'adresse'=>$faker->address,
    				]
    			);
    		}
    }
}

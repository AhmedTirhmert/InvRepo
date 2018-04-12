<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
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
    			DB::table('client')->insert(
    				[
    				'nom'=>$faker->lastName,
    				'prenom'=>$faker->firstName,
    				'email'=>$faker->email,
    				'telephone'=>$faker->phoneNumber,
    				'created_at'=>$faker->dateTime,
    				'updated_at'=>$faker->dateTime,
    				]
    			);
    		}
    }
}

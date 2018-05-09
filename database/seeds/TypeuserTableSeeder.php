<?php

use Illuminate\Database\Seeder;

class TypeuserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           	$type_user = ['Admin','Client'];

        $faker = Faker\Factory::create();
    		$limit = 2;

    		for ($i=0; $i < $limit; $i++) { 
    			DB::table('type_user')->insert(
    				[
    				
    				
    				'role'=>$type_user[$i],
    				
    				]
    			);
    		}   


    }
}

<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
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
                 $name =   $faker->name;
                 DB::table('users')->insert(
                     [
                    'name' =>$name,
                    'email' => $faker->unique()->safeEmail,
                    'id_type' => 2,
                    'password' => Hash::make($name), // secret
                    'remember_token' => str_random(10), 
                     
                     ]
                 );
             }   
             }
}

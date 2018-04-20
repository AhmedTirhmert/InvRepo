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
                if ($i == 0) {
                    DB::table('users')->insert(
                     [
                    'name' =>"Ahmed Tirhmert",
                    'email' => "ahmed.tirhmert@gmail.com",
                    'id_type' => 1,
                    'password' => Hash::make("hellofromhere"), // secret
                    'remember_token' => str_random(10), 
                     
                     ]
                 );
                }elseif ($i==1) {
                    DB::table('users')->insert(
                     [
                    'name' =>"Rahma Maissou",
                    'email' => "Maissou.rahma@gmail.com",
                    'id_type' => 1,
                    'password' => Hash::make("12301230"), // secret
                    'remember_token' => str_random(10), 
                     
                     ]
                 );
                }else{
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
             }   }
             }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClientTableSeeder::class);
        $this->call(CategorieTableSeeder::class);
        $this->call(ProduitTableSeeder::class);
   
    }
}


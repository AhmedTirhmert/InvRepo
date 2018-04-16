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

        $this->call(EtatcommandeTableSeeder::class);
        $this->call(TypeutilisateurTableSeeder::class);
        $this->call(CategorieTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(UtilisateurTableSeeder::class);
        $this->call(ProduitTableSeeder::class);
        $this->call(CommandeTableSeeder::class);
        $this->call(ConcerneTableSeeder::class);
   
    }
}


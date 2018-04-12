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

<<<<<<< HEAD


        $this->call(ClientTableSeeder::class);
=======
        /*$this->call(EtatcommandeTableSeeder::class);
        $this->call(TypeutilisateurTableSeeder::class);
>>>>>>> 3975dccbdb307706d638889d366e847d67c4e4f1
        $this->call(CategorieTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(UtilisateurTableSeeder::class);
        $this->call(ProduitTableSeeder::class);
        $this->call(CommandeTableSeeder::class);*/
        $this->call(ConcerneTableSeeder::class);
   
    }
}


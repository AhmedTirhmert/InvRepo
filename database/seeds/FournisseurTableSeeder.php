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
        factory(App\Fournisseur::class, 50)->create();
    }
}

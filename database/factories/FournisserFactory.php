<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Fournisseur::class, function (Faker $faker) {
    return [
        'code_f' => $faker->code_f,
        'nom' => $faker->nom,
        'prenom' => $faker->prenom,
        'Adresse' => $faker->Adresse,
        'telephone' => $faker->telephone,
        'email' => $faker->unique()->safeEmail,


        'remember_token' => str_random(10),
    
            
    ];
});
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@home')->name('home')->middleware('home');
Route::get('/Dashboard', 'TestController@Dashboard')->name('Dashboard')->middleware('dashboard');

//Commande Routes
	//GET
Route::get('/cmnd_dtl/{id}', 'HomeController@cmnd_dtl');
Route::get('/cmnd_approval/{id}', 'TestController@cmnd_approval');
Route::get('/commande/cmnd_approved', 'TestController@cmnd_approved');
Route::get('/commandes_filter/{annee}/{etat}', 'TestController@commandes_filter');
	//POST
Route::post('/commande/insertNewCommande', 'HomeController@insertNewCommande');
Route::post('/commande/cmnd_approved', 'TestController@cmnd_approved');



//User Routes
	//GET
Route::get('/users/get_user_info/{id}', 'TestController@get_user_info');
Route::get('/users/user_Existence/{name}/{email}', 'TestController@User_Existence');
	//POST
Route::post('/users/insertNewUser', 'TestController@insertNewUser');
Route::post('/users/update_user', 'TestController@update_user');



//Fournisseur Routes
	//GET
Route::get('/Fournisseurs/get_fournisseur_info/{Code_fournisseur}', 'TestController@get_fournisseur_info');
Route::get('/Fournisseurs/Fournisseur_Existence/{name}/{email}/{telephone}', 'TestController@Fournisseur_Existence');
	//POST
Route::post('/Fournisseurs/insertNewFournisseur', 'TestController@insertNewFournisseur');
Route::post('/Fournisseurs/update_Fournisseur', 'TestController@update_Fournisseur');



//Produit Routes
	//GET
Route::post('/Produits/update_Produit', 'TestController@update_Produit');
Route::post('/Produits/insertNewProduit', 'TestController@insertNewProduit');
	//POS
Route::get('/Produits/Produit_Existence/{Reference}', 'TestController@Produit_Existence');
Route::get('/Produits/get_Produit_info/{Code_Produit}', 'TestController@get_Produit_info');


//STATISTICS
Route::get('/statistics/{top10year}/{top10}', 'TestController@statistics');
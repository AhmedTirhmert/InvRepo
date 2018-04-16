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


Route::get('/', function () {

});


Route::get('/mypage', 'TestController@contact');

Route::get('/insertadmin', 'TestController@insertadmin');

Route::get('/selectadminsnames', 'TestController@selectadminsnames');

Route::get('/selectadminname/{id}', 'TestController@selectadminname');

Route::get('/selectallproducts', 'TestController@selectallproducts');

Route::get('/selectalltypesamounts', 'TestController@selectalltypesamounts');

Route::get('/selectallproductswithcategorie', 'TestController@selectallproductswithcategorie');

Route::get('/select_admins_using_model', 'admin@select_admins_using_model');

Route::get('admins/create', 'admin@create');

Route::get('admins/inserted', 'admin@store');







Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

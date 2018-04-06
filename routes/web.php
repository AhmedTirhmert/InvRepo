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
    return view('welcome')->with('variable', 15);
});

Route::get('/connect',function(){
	
	return view('welcome')->with('hello', "je suis rahma maissou");
});

Route::get('/contact/{name}',function($name){
	echo" je suis " . $name;
});
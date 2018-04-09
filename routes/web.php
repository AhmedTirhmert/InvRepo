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
    return view('welcome')->with('variable', "welcome FROM welcome");
});

Route::get('/contact','TestController@contact');

/*Route::get('/contact/{name}',function($name){
	echo" je suis " . $name;
});

Route::get('/contact/{name}/age/{age}',function($name,$age){
    echo" je suis " . $name . " de l'age " . $age . "ans";
})  ->where(['name' => '[a-zA-Z]+', 'age'=>'[0-9]+']);
*/

Route::get('/mypage', function(){
	
	return view('test')->with('variable', "hello from test");
});


Route::get('/',function () {
    return view('welcome')->with('hello', "hello from welcome");
});



Route::get('/contact/{name}',function($name){
	echo" je suis " . $name;
});












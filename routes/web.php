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
    return view('welcome');
});

Route::get('/books/index','BookController@index');

Route::post('/books',"BookController@store");

Route::patch('/books/{book}','BookController@update');

Route::delete('/books/{book}','BookController@delete');

Route::post('/authors','AuthorController@add');

Route::get('info',function(){
    phpinfo();
});

Route::post('/books/checkedout/{book}','CheckOutController@store');

Route::post('/books/checkedin/{book}','CheckInBookController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




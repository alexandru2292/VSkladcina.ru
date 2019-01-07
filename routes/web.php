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
Route::get('/', ['uses'=> 'StockController@index'])->name('index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/registerUser', 'Auth\RegisterController@create')->name('registerUser');
Route::post('/loginUser', 'Auth\LoginController@login')->name('loginUser');
Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);
Route::get('500', ['as' => '500', 'uses' => 'ErrorController@fatal']);


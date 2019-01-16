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
Route::get('/login', ['uses' => 'LoginController@login']);
Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function (){
    Route::get('/', 'ProfileController@index')->name('profileIndex');
    Route::get('/stock/add', ['uses'=> 'StockController@StockEdit'])->name('stockEdit');
    Route::post('/stock/add', ['uses'=> 'StockController@stockAdd'])->name('stockAdd');
    Route::put('/stock/update', ['uses'=> 'StockController@stockUpdate'])->name('stockUpdate');
    Route::post('/stock/add/paragraph', ['uses'=> 'StockController@addParagraph']);
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/registerUser', 'Auth\RegisterController@create')->name('registerUser');
Route::get('/exit_from_profile', 'ProfileController@exitFromProfile')->name('profileExit');
Route::post('/loginUser', 'Auth\LoginController@login')->name('loginUser');
Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

/**
 * Socialite
 *
 */
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

Route::get('vkauth', 'SocialAuthVkController@login');
Route::get('vkredirect', 'SocialAuthVkController@redirect');
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
Route::get('/', ['uses'=> 'StockController@index', 'as' => 'index']);
Route::get('/card/{id}', ['uses'=> 'StockController@showCard', 'as' => 'showCard']);
Route::get('/moderation', ['uses'=> 'StockController@showModerationStocks']);
Route::post('/edit_status', ['uses'=> 'StockController@editStatus']);

Route::get('/login', ['uses' => 'LoginController@login']);

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function (){
    Route::get('/', 'ProfileController@index')->name('profileIndex');
    Route::get('/stock/add', ['uses'=> 'StockController@StockEdit', 'as' => 'stockEdit']);
    Route::post('/stock/add', ['uses'=> 'StockController@stockAdd', 'as' => 'stockAdd']);
    Route::post('/stock/add_img_with_ckeditor', ['uses'=> 'StockController@addImgWithCkeditor']);
    Route::post('/stock/store', ['uses'=> 'StockController@store', 'as' => 'stockStore']);
    Route::post('/stock/rmSessName', ['uses'=> 'StockController@rmSessName']);
    Route::post('/stock/rmSessTitle', ['uses'=> 'StockController@rmSessTitle']);
    Route::post('/stock/rmSessParagraph', ['uses'=> 'StockController@rmSessParagraph']);
    Route::post('/stock/rmSessYtLink', ['uses'=> 'StockController@rmSessYtLink']);
    Route::post('/stock/rmSessTags', ['uses'=> 'StockController@rmSessTags']);
});


Auth::routes();
Route::get('/home', ['uses'=> 'HomeController@index', 'as' => 'home']);
Route::post('/registerUser', ['uses'=>'Auth\RegisterController@create', 'as' => 'registerUser']);
Route::get('/exit_from_profile', ['uses' => 'ProfileController@exitFromProfile', 'as' => 'profileExit']);
Route::post('/loginUser', ['uses' => 'Auth\LoginController@login', 'as'=> 'loginUser']);
Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);


Route::get('logout', ['uses' => '\App\Http\Controllers\Auth\LoginController@logout', 'as'=> 'logout']);

/**
 * Socialite
 *
 */
Route::get('/follows/{stock_id}', ['uses' => "FollowerController@follows", 'as' => 'follows']);
Route::get('/un_follows/{stock_id}', ['uses' => "FollowerController@unFollows"]);
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

Route::get('vkauth', 'SocialAuthVkController@login');
Route::get('vkredirect', 'SocialAuthVkController@redirect');

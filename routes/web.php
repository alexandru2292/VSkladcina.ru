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
Route::get('/card/{id}/{allStatus?}', ['uses'=> 'StockController@showCard', 'as' => 'showCard']);

Route::post('/edit_status', ['uses'=> 'StockController@editStatus']);

Route::get('/login', ['uses' => 'LoginController@login']);

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function (){
    Route::get('/', 'ProfileController@index')->name('profileIndex');
    Route::get('/stock/add/{id?}', ['uses'=> 'StockController@StockEdit', 'as' => 'stockEdit']);
    Route::post('/stock/add', ['uses'=> 'StockController@stockAdd', 'as' => 'stockAdd']);
    Route::post('/stock/update', ['uses'=> 'StockController@stockUpdate', 'as' => 'stockUpdate']);

    Route::post('/stock/add_img_with_ckeditor', ['uses'=> 'StockController@addImgWithCkeditor']);
    Route::post('/stock/store', ['uses'=> 'StockController@store', 'as' => 'stockStore']);
    Route::post('/stock/rmSessName', ['uses'=> 'StockController@rmSessName']);
    Route::post('/stock/rmSessTitle', ['uses'=> 'StockController@rmSessTitle']);
    Route::post('/stock/rmSessParagraph', ['uses'=> 'StockController@rmSessParagraph']);
    Route::post('/stock/rmSessYtLink', ['uses'=> 'StockController@rmSessYtLink']);
    Route::post('/stock/rmSessTags', ['uses'=> 'StockController@rmSessTags']);
    Route::get('/my_stocks', ['uses'=> 'StockController@getMyStocks']);
    Route::get('/stock/edit/{id}', ['uses'=> 'StockController@StockEdit', 'as' => "editCard"]);

    /**
     * The messages
     */
    Route::get('/messages', ['uses'=> 'MessageController@showMessages']);

    Route::post('/showDialog', ['uses' => 'MessageController@showDialog']);
    Route::post('/ifNewMessage', ['uses' => 'MessageController@ifNewMessage']);
    Route::post('/updateIsReadColumn', ['uses' => 'MessageController@updateIsReadColumn']);
    Route::post('/sendNewMessage', ['uses' => 'MessageController@sendNewMessage']);
    Route::post('/removeDialog', ['uses' => 'MessageController@removeDialog']);
    Route::post('/checkIfExistNewMessage', ['uses' => 'MessageController@checkIfExistNewMessage']);

    Route::get('/stocks_for_moderation', ['uses'=> 'StockController@showModerationStocks']);
    Route::get('/stocks_for_editing', ['uses'=> 'StockController@getOnEditing']);



});

Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function (){
    Route::get('/', ['uses' => 'AdminController@index', 'as' => 'admin']);
    Route::get('/deleteStock/{id}', ['uses' => 'AdminController@deleteStock', 'as' => 'deleteStock']);
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

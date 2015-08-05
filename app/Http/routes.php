<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('test', 'ArticleController@redir');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/', function()
{
    return view('articles');
});
/*
 * API routes
 */
Route::group(['prefix' => 'api', 'before' => 'oauth'], function() {
    Route::resource('articles', 'ArticleController', array('except' => array('create', 'edit', 'update')));
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});
Route::post('oauth/setToken/{token}', 'ArticleController@setOCookie');
Route::get('oauth/getToken', 'ArticleController@getOCookie');

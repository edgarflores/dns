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


Route::get('/', 'DnsController@index');
Route::get('/show', 'DnsController@show');
Route::post('/net', 'DnsController@net2');
Route::get('/net', 'DnsController@net2');
Route::post('/search', 'DnsController@search');
Route::get('/create', 'DnsController@create');
Route::post('/store', 'DnsController@store');
Route::get('/edit', 'DnsController@edit');
Route::get('/edit/{dnslst}', 'DnsController@edit');
Route::put('/store', 'DnsController@update');
Route::put('/store/{dnslst}', 'DnsController@update');
Route::delete('/destroy', 'DnsController@destroy');
Route::delete('/destroy/{dnslst}', 'DnsController@destroy');

Route::get('/findip', 'DnsController@findip');
Route::get('/findresult', 'DnsController@findresult');
Route::get('/findresult/{ipresult}', 'DnsController@findresult');




Route::get('adm',
[
  'uses'  => 'DnsController@indexAdm',
  'as'    =>  'Adm'
  ]);

Route::get('home',
[
  'uses'  =>  'HomeController@index',
  'as'    =>  'home'
]);


/*
* ruta de Authentication
*/

// Authentication routes...
Route::get('login',
[
  'uses'  =>  'Auth\AuthController@getLogin',
  'as'    =>  'login'
]);

Route::post('login', [
  'uses'  => 'Auth\AuthController@postLogin',
  'as'    => 'login'
]);

Route::get('logout', [
  'uses'  =>  'Auth\AuthController@getLogout',
  'as'    =>  'logout'
  ]);

// Registration routes...
Route::get('register',
[
  'uses'  =>  'Auth\AuthController@getRegister',
  'as'    =>  'register'
]);

Route::post('register',
[
  'uses'  =>  'Auth\AuthController@postRegister',
  'as'    =>  'register'
]);

/*
*Ruta de reset password
*/
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

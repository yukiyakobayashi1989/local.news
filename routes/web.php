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

//php10追記　→　php14追記
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
  Route::get('news/create', 'Admin\NewsController@add');
  Route::post('news/create', 'Admin\NewsController@create'); # 追記
  Route::get('news', 'Admin\NewsController@index');//php16追記
  //追加課題
  //Route::get('news', 'Admin\NewsController@sort');

  Route::get('news/edit', 'Admin\NewsController@edit');
  Route::post('news/edit', 'Admin\NewsController@update');
  Route::get('news/delete', 'Admin\NewsController@delete');

  //php10課題
  Route::get('profile/create','Admin\ProfileController@add');
  Route::post('profile/create', 'Admin\ProfileController@create'); # php14課題追記
  Route::get('profile/edit','Admin\ProfileController@edit');
  Route::post('profile/edit','Admin\ProfileController@update');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'NewsController@index');

//追加課題
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

});

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

//php10追記
Route::group(['prefix' => 'admin'], function(){
  Route::get('news/create','Admin\NewsController@add');
  //php10課題
  Route::get('profile/create','Admin\ProfileController@add');
  Route::get('profile/edit','Admin\ProfileController@edit');
});

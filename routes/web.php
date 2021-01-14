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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('users')->name('users.')->group(function () {
    Route::get('{id}', 'UserController@show')->name('show');
    Route::get('{id}/edit', 'UserController@edit')->name('edit');
    Route::post('{id}', 'UserController@update')->name('update');
    Route::get('{id}/email', 'UserController@emailEdit')->name('emailEdit');
    Route::put('{id}/email', 'UserController@emailUpdate')->name('emailUpdate');
    Route::get('{id}/pass', 'UserController@passEdit')->name('passEdit');
    Route::put('{id}/pass', 'UserController@passUpdate')->name('passUpdate');
    Route::get('{id}/withdraw', 'UserController@withdraw')->name('withdraw');
    Route::delete('{id}/delete', 'UserController@destroy')->name('destroy');
});

Route::prefix('themes')->name('themes.')->group(function () {
    Route::get('create', 'ThemeController@create')->name('create');
    Route::post('store', 'ThemeController@store')->name('store');
    Route::get('{id}/result', 'ThemeController@result')->name('result');
    Route::get('{id}', 'ThemeController@show')->name('show');
    Route::post('{id}', 'ThemeController@answer')->name('answer');
    Route::get('{id}/edit', 'ThemeController@edit')->name('edit');
    Route::put('{id}', 'ThemeController@update')->name('update');
    Route::delete('{id}', 'ThemeController@destroy')->name('destroy');
    Route::get('', 'ThemeController@index')->name('index');
});

Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('', 'ContactController@index')->name('index');
    Route::post('', 'ContactController@send')->name('send');
});

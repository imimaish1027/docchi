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


Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});

Route::prefix('register')->name('register.')->group(function () {
    Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
    Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');

Route::prefix('users')->name('users.')->group(function () {
    Route::get('{id}', 'UserController@show')->name('show');
    Route::get('{id}/answer', 'UserController@answer')->name('answer');
    Route::get('{id}/edit', 'UserController@edit')->name('edit');
    Route::post('{id}', 'UserController@update')->name('update');
    Route::get('{id}/bookmark', 'UserController@bookmark')->name('bookmark');
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
    Route::post('{id}/comment', 'ThemeController@comment')->name('comment');
    Route::get('{id}', 'ThemeController@show')->name('show');
    Route::post('{id}', 'ThemeController@answer')->name('answer');
    Route::get('{id}/edit', 'ThemeController@edit')->name('edit');
    Route::put('{id}', 'ThemeController@update')->name('update');
    Route::delete('{id}', 'ThemeController@destroy')->name('destroy');
    Route::get('', 'ThemeController@index')->name('index');
    Route::put('{id}/bookmark', 'ThemeController@bookmark')->name('bookmark')->middleware('auth');
    Route::delete('{id}/bookmark', 'ThemeController@unbookmark')->name('unbookmark')->middleware('auth');
});

Route::get('tags/{name}', 'TagController@show')->name('tags.show');

Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('', 'ContactController@index')->name('index');
    Route::post('confirm', 'ContactController@confirm')->name('confirm');
    Route::post('sent', 'ContactController@send')->name('send');
});

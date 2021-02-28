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

Route::get('/', 'TopController@index')->name('top');

Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');

Route::prefix('users')->name('users.')->group(function () {
    Route::get('{id}', 'UserController@show')->name('show');
    Route::get('{id}/answer', 'UserController@answer')->name('answer');
    Route::group(['middleware' => 'auth'], function () {
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
});

Route::prefix('themes')->name('themes.')->group(function () {
    Route::get('create', 'ThemeController@create')->name('create')->middleware('auth');
    Route::post('store', 'ThemeController@store')->name('store')->middleware('auth');
    Route::get('{id}/result', 'ThemeController@result')->name('result');
    Route::post('{id}/comment', 'ThemeController@comment')->name('comment')->middleware('auth');
    Route::get('{id}', 'ThemeController@show')->name('show');
    Route::post('{id}', 'ThemeController@answer')->name('answer')->middleware('auth');
    Route::get('{id}/edit', 'ThemeController@edit')->name('edit')->middleware('auth');
    Route::put('{id}', 'ThemeController@update')->name('update')->middleware('auth');
    Route::delete('{id}', 'ThemeController@destroy')->name('destroy')->middleware('auth');
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

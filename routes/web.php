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
    return redirect('/films');
});

Route::get('films', 'FilmsController@index');
Route::get('films/create', 'FilmsController@create');
Route::post('films/create', 'FilmsController@createFilm');
Route::get('films/{slug}', 'FilmsController@view');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

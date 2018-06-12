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
Route::get('/pdf','PdfController@index');


Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::resource('posts','PostsController');
Route::resource('players','PlayerController');
Route::resource('games','GameController');
 Route::resource('bets','BetController');
Route::get('/tables', 'TableController@index');



Route::get('/players/index/action', 'PlayerController@action')->name('index.action');
Route::post('/games/create/fetch', 'GameController@fetch')->name('dynamicdependent.fetch');


Route::get('/bets/chart/action', 'BetController@action')->name('chart.action');

/*
Route::get('/about', function () {
    return view('pages.about');
});
/*
Route::get('/users/{id}', function ($id) {
    return 'this is user'.$id;
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

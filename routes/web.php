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

// Route::get('/', function () {
//     return view('renkohsasaki.index');
// });
Route::get('/', 'RenkohSasakiController@index')->name('index');
Route::post('/contact', 'RenkohSasakiController@contact')->name('contact');
Route::get('/test', 'RenkohSasakiController@test')->name('test');

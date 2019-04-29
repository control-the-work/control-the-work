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

Route::get('/', 'HomeController@index')->name('home');

/**********************************************************************
 * EVENTS
 *********************************************************************/

//Route::get('events/listDatatables', 'EventController@listDatatables');
Route::resource('events', 'EventController');
/**********************************************************************
 * USERS
 *********************************************************************/
Route::resource('/users', 'UserController');
Auth::routes(['verify' => true, 'register' => false,]);


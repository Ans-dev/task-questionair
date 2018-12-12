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

Route::get('/','HomeController@index')->name('home');;

Auth::routes();

Route::resource('questioniers', 'QuestionierController');

//Other routes of Questionair Controller
Route::get('/question/create/{id}','QuestionierController@create_question')->name('create-question');
Route::post('/question/store','QuestionierController@store_question')->name('store-question');

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
/**
 * here we are routing the resource route execpt the show method
 * in 'show' method by defult the the url will show the question id.
 * instead of that we will use slug to make the url user friendly
 * to do so, we need to exect the show method from the resource route
 * then manually create the route for the show method
 * then we have to bind the route
 * to achive that we need to go boot method is Providers/RouteServiceProvider 
 */
Route::group(['middleware' => ['auth']], function () {
    Route::resource('questions', 'QuestionsController')->except('show');
    Route::get('/questions/{slug}','QuestionsController@show')->name('questions.show');    
});


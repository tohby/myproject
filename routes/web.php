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
//     return view('home');
// });

Auth::routes();
Route::get('/', 'QuestionController@index');
Route::get('/my-questions', 'QuestionController@myQuestions');
Route::get('/unsolved', 'QuestionController@unsolved');
Route::get('/trash', 'QuestionController@trash');
Route::get('/solved', 'QuestionController@solved');
Route::get('/profile/{user}', 'ProfileController@show');
Route::resource('/question', 'QuestionController');
Route::resource('/comment', 'CommentController');
Route::resource('/best-reply', 'BestReply');
Route::get('/search/{searchKey}', 'SearchController@search');
Route::post('/search', 'SearchController@search');
// Route::get('/restore/{question}', 'QuestionController@restore');
Route::post('/question/{question}/restore', 'QuestionController@restore');

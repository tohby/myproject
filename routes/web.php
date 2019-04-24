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
Route::get('/solved', 'QuestionController@solved');
Route::get('/profile/{user}', 'ProfileController@show');
Route::resource('/question', 'QuestionController');
Route::resource('/comment', 'CommentController');
Route::post('/best-reply', 'QuestionController@bestReply');

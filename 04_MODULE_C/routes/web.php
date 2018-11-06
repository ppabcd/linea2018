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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/forgot', 'UserController@forgot')->name('forgot');
Route::post('/forgot', 'UserController@forgotCheck');

Route::get('/log', 'LogController@index')->middleware('auth');


// Guru
Route::get('/classroom','ClassController@index')->middleware(['auth','guru']);
Route::get('/classroom/add', 'ClassController@add')->middleware(['auth','guru']);
Route::post('/classroom/add','ClassController@addSubmit')->middleware(['auth','guru']);

Route::get('/exam', 'ExamController@index')->middleware(['auth','guru']);
Route::post('/exam/add', 'ExamController@addSubmit')->middleware(['auth','guru']);
Route::get('/exam/delete/{id}','ExamController@delete')->middleware(['auth','guru']);
Route::get('/exam/manage/{id}','ExamController@manage')->middleware(['auth','guru']);

Route::post('/exam/manage/{id}/multiple','ExamController@multiple')->middleware(['auth','guru']);
Route::get('/exam/manage/{id}/multiple/{m}/delete','ExamController@multipleDelete')->middleware(['auth','guru']);

Route::post('/exam/manage/{id}/essay','ExamController@essay')->middleware(['auth','guru']);
Route::get('/exam/manage/{id}/essay/{m}/delete','ExamController@essayDelete')->middleware(['auth','guru']);

Route::get('/assess','AssessController@index')->middleware(['auth','guru']);
Route::get('/assess/{id}','AssessController@show')->middleware(['auth','guru']);
Route::get('/assess/{id}/{sid}', 'AssessController@student')->middleware(['auth','guru']);
Route::post('/assess/{id}/{sid}', 'AssessController@score')->middleware(['auth','guru']);

Route::get('/statistic', 'StatisticController@index')->middleware(['auth','guru']);


// Siswa
Route::get('/answer','SiswaExamController@index')->middleware(['auth','siswa']);
Route::get('/answer/{id}','SiswaExamController@show')->middleware(['auth','siswa']);
Route::post('/answer/{id}','SiswaExamController@showSubmit')->middleware(['auth','siswa']);

Route::get('/score', 'SiswaScoreController@index')->middleware(['auth','siswa']);
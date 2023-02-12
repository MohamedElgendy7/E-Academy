<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::post('/', 'HomeController@profile')->name('student-profile');
Route::get('/video/{Student_id}', 'HomeController@video')->name('video.user');
Route::get('/docs/{grade_id}/{student_id}', 'HomeController@Doc')->name('Docs.user');
Route::get('/grades/{student_id}', 'HomeController@gradeDetect')->name('grade.user');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/test', 'HomeController@test');

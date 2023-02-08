<?php

use App\Http\Controllers\admin\LoginController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can admin web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


define('PAGINATION_COUNT', 10);
define('domain', '192.168.43.197');


Route::group(
    ['namespace' => 'admin', 'middleware' => 'guest:admin'],

    function () {
        Route::get('/login', 'LoginController@getLogin')->name('get.admin.login');
        Route::post('/login', 'LoginController@login')->name('admin.login');
    }
);


Route::group(
    ['namespace' => 'Admin', 'middleware' => 'auth:admin'],
    function () {
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');

        ######################### Begin Main Categoris Routes ########################
        Route::group(['prefix' => 'main_categories'], function () {
            Route::get('/', 'MainCategoriesController@index')->name('admin.maincategories');

            Route::get('create', 'MainCategoriesController@create')->name('admin.maincategories.create');
            Route::post('store', 'MainCategoriesController@store')->name('admin.maincategories.store');

            Route::get('edit/{id}', 'MainCategoriesController@edit')->name('admin.maincategories.edit');
            Route::post('update/{id}', 'MainCategoriesController@update')->name('admin.maincategories.update');

            Route::get('delete/{id}', 'MainCategoriesController@destroy')->name('admin.maincategories.delete');

            Route::get('changeStatus/{id}', 'MainCategoriesController@changeStatus')->name('admin.maincategories.status');

            Route::get('info/{id}', 'MainCategoriesController@show')->name('admin.maincategories.show');
        });
        ######################### End Main Categoris Route ########################

        ######################### Begin grades Routes ########################
        Route::group(['prefix' => 'grades'], function () {
            Route::get('/', 'GradesController@index')->name('admin.grades');

            Route::get('create/{cat_id}', 'GradesController@create')->name('admin.grades.create');
            Route::post('store', 'GradesController@store')->name('admin.grades.store');

            Route::get('edit/{id}', 'GradesController@edit')->name('admin.grades.edit');
            Route::post('update/{id}', 'GradesController@update')->name('admin.grades.update');

            Route::get('delete/{id}', 'GradesController@destroy')->name('admin.grades.delete');

            Route::get('changeStatus/{id}', 'GradesController@changeStatus')->name('admin.grades.status');

            Route::get('show/{id}', 'GradesController@show')->name('admin.grades.show');
        });
        ######################### End grades Route ########################

        ######################### Begin students Routes ########################
        Route::group(['prefix' => 'student'], function () {
            Route::get('/', 'StudentController@index')->name('admin.student');

            Route::get('create/{group_id}', 'StudentController@create')->name('admin.student.create');
            Route::post('store', 'StudentController@store')->name('admin.student.store');

            Route::get('edit/{id}', 'StudentController@edit')->name('admin.student.edit');
            Route::post('update/{id}', 'StudentController@update')->name('admin.student.update');

            Route::get('show/{id}', 'StudentController@show')->name('admin.student.show');

            Route::get('delete/{id}', 'StudentController@destroy')->name('admin.student.delete');

            Route::get('changeStatus/{id}', 'StudentController@changeStatus')->name('admin.student.status');

            Route::get('student_profile/{id}', 'StudentController@profile')->name('admin.student.profile');
        });
        ######################### End students Route ########################


        ######################### Begin groups Routes ########################
        Route::group(['prefix' => 'groups'], function () {

            Route::get('/', 'GroupsController@index')->name('admin.groups');

            Route::get('create/{id}', 'GroupsController@create')->name('admin.groups.create');
            Route::post('store', 'GroupsController@store')->name('admin.groups.store');

            Route::get('edit/{id}', 'GroupsController@edit')->name('admin.groups.edit');
            Route::post('update/{id}', 'GroupsController@update')->name('admin.groups.update');

            Route::get('delete/{id}', 'GroupsController@destroy')->name('admin.groups.delete');

            Route::get('changeStatus/{id}', 'GroupsController@changeStatus')->name('admin.groups.status');
        });
        ######################### End groups Route ########################


        ######################### Begin absent Routes ########################

        Route::group(['prefix' => 'absent'], function () {
            //absent from dashboard
            Route::get('/', 'AbsentController@create')->name('admin.absent.create');
            Route::post('store', 'AbsentController@store')->name('admin.absent.store');
            //absent from QR code
            Route::get('/qr/{id}', 'AbsentController@QRstore');
            Route::get('/download-QR/{id}', 'AbsentController@download')->name('download');
        });

        ######################### End absent Route ########################


        ######################### Begin video Routes ########################
        Route::group(['prefix' => 'video'], function () {
            Route::get('/', 'VideoController@index')->name('admin.video.index');

            Route::get('create', 'VideoController@create')->name('admin.video.create');
            Route::post('store', 'VideoController@store')->name('admin.video.store');

            Route::get('delete/{id}', 'VideoController@destroy')->name('admin.video.delete');

            Route::get('changeStatus/{id}', 'VideoController@changeStatus')->name('admin.video.status');
        });
        ######################### End video Route ########################



        ######################### Begin doc Routes ########################
        Route::group(['prefix' => 'doc'], function () {
            Route::get('/', 'DocController@index')->name('admin.doc.index');

            Route::get('create/{id}', 'DocController@create')->name('admin.doc.create');
            Route::post('store', 'DocController@store')->name('admin.doc.store');

            Route::get('delete/{id}', 'DocController@destroy')->name('admin.doc.delete');

            Route::get('changeStatus/{id}', 'DocController@changeStatus')->name('admin.doc.status');
        });
        ######################### End doc Route ########################


        ######################### Begin degree Routes ########################
        Route::group(['prefix' => 'degree'], function () {
            Route::get('/{id}', 'DegreeController@index')->name('admin.degree');
            Route::get('create/{id}', 'DegreeController@create')->name('admin.degree.create');
            Route::get('show/{id}', 'DegreeController@show')->name('admin.degree.show');
            Route::get('results/{group_id}/{exam_id}', 'DegreeController@results')->name('admin.degree.results');
            Route::post('store', 'DegreeController@store')->name('admin.degree.store');
        });
        ######################### End degree Route ########################

        ######################### Begin exam Routes ########################
        Route::group(['prefix' => 'exam'], function () {
            Route::get('/', 'ExamController@index')->name('admin.exam');
            Route::get('/create', 'ExamController@create')->name('admin.exam.create');
            Route::post('store', 'ExamController@store')->name('admin.exam.store');
            Route::get('edit/{id}', 'ExamController@edit')->name('admin.exam.edit');
            Route::post('update/{id}', 'ExamController@update')->name('admin.exam.update');

            Route::get('delete/{id}', 'ExamController@destroy')->name('admin.exam.delete');
        });
        ######################### End exam Route ########################


        ######################### Begin cash Routes ########################
        Route::group(['prefix' => 'cash'], function () {
            Route::get('/{group_id}', 'CashController@create')->name('admin.cash.create');
            Route::post('/', 'CashController@store')->name('admin.cash.store');
            Route::get('changeStatus/{id}', 'MonthController@changeStatus')->name('admin.cash.changeStatus');
            Route::get('/', 'CashController@index')->name('admin.cash.month.index');
            Route::get('/create', 'MonthController@create')->name('admin.cash.month.create');
            Route::post('store', 'MonthController@store')->name('admin.cash.month.store');
            Route::get('/delete/{id}', 'MonthController@destroy')->name('admin.cash.month.delete');
        });
        ######################### End cash Route ########################
    }
);

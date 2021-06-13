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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index')->name('home');

   // Permissions
//    Route::delete('permissions/destroy', 'PermissionsController@massDestroy');
//    Route::resource('permissions', 'PermissionsController');

    // Roles
//    Route::delete('roles/destroy', 'RolesController@massDestroy');
//    Route::resource('roles', 'RolesController');

    // Users
//    Route::delete('users/destroy', 'UsersController@massDestroy');
//    Route::resource('users', 'UsersController');

    // Lessons
    Route::delete('lessons/destroy', 'LessonsController@massDestroy');
    Route::resource('lessons', 'LessonsController');

    // School Classes
//    Route::delete('school-classes/destroy', 'SchoolClassesController@massDestroy');
//    Route::resource('school-classes', 'SchoolClassesController');

});

//Route::get('calendar', 'CalendarController@index')->name('calendar.index');

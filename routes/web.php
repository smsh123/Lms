<?php

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

 /* All front Url */
Route::get('/', 'HomeController@index'); 
Route::get('/cms', 'DashboardController@index');
Route::get('/cms/courses', 'DashboardController@courses'); 
// Route::get('/cms/courses/add', 'DashboardController@courseCreate');
Route::get('/cms/courses/edit', 'DashboardController@courseEdit'); 
Route::get('/cms/courses/delete', 'DashboardController@courseDelete'); 
Route::get('/cms/courses/view', 'DashboardController@courseViewStatus'); 
Route::post('/register', 'UserController@register'); 
/* All cms routes */
Route::prefix('cms')->group(function () {
    Route::get('/', 'DashboardController@index'); 
    Route::get('/courses', 'CourseController@index'); 
    Route::get('/courses/add', 'CourseController@add');
    Route::post('/courses/store', 'CourseController@store');
    Route::get('/courses/edit', 'DashboardController@courseEdit'); 
    Route::get('/cms/courses/delete', 'DashboardController@courseDelete'); 
    Route::get('/cms/courses/view', 'DashboardController@courseViewStatus'); 
});



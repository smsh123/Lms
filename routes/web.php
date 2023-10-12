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
/* All cms routes */
Route::prefix('cms')->namespace('Cms')->group(function () {
    Route::get('/', 'DashboardController@index'); 
});
Route::get('/cms/courses/index', function () {
    return view('cms.courses.index');
});
Route::get('/cms/courses/add', function () {
    return view('cms.courses.add');
});
Route::get('/cms/courses/edit', function () {
    return view('cms.courses.add');
});
Route::get('/cms/courses/delete', function () {
    return view('cms.courses.add');
});
Route::get('/cms/courses/view', function () {
    return view('cms.courses.add');
});



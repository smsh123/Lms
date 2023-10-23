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
// Route::post('/register', 'UserController@register'); 
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::post('reset_password_without_token', 'AuthController@validatePasswordRequest');
Route::post('reset_password_with_token', 'AuthController@resetPassword');
Route::get('/reset/password/{token}', 'AuthController@resetPasswordForm');
Route::get('image-upload', 'ImageUploadController@imageUpload')->name('image.upload');
Route::post('image-upload','ImageUploadController@imageUploadPost')->name('image.upload.post');
/* All cms routes */
Route::prefix('cms')->middleware(['internal'])->group(function () {
    Route::get('/', 'DashboardController@index'); 
    Route::get('/courses', 'CourseController@index')->name('courses.index'); 
    Route::get('/courses/add', 'CourseController@add')->name('courses.add');
    Route::post('/courses/store', 'CourseController@store')->name('courses.store');
    Route::get('/courses/edit/{id}', 'CourseController@courseEdit')->name('courses.edit'); 
    Route::get('/courses/update', 'CourseController@courseEdit')->name('courses.update'); 
    Route::get('/users', 'UserController@listUsers')->name('users.index');
    Route::get('/users/add', 'UserController@addUsers')->name('users.add');
    Route::get('/banners', 'BannerController@listBanners')->name('banners.index');
    Route::get('/banners/add', 'BannerController@addBanners')->name('banners.add');
    Route::post('/banners/store', 'BannerController@store')->name('banners.store');
});



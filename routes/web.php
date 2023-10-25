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
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::get('/profile/{id}', 'ProfileController@profile');
Route::get('/courses/{id}', 'ProfileController@courses');
Route::get('/orders/{id}', 'ProfileController@orders');
Route::get('/reports/{id}', 'ProfileController@reports');
Route::get('/course', 'CourseController@listing');
Route::get('/blogs', 'BlogController@listing');
Route::get('/success-stories', 'TestimonialController@listing');
Route::post('reset_password_without_token', 'AuthController@validatePasswordRequest');
Route::post('reset_password_with_token', 'AuthController@resetPassword');
Route::get('/reset/password/{token}', 'AuthController@resetPasswordForm');
Route::post('/image-upload-post','ImageUploadController@imageUploadPost');
/* All cms routes */
Route::prefix('cms')->middleware(['internal'])->group(function () {
    Route::get('/', 'DashboardController@index'); 
    Route::get('/courses', 'CourseController@index')->name('courses.index'); 
    Route::get('/courses/add', 'CourseController@add')->name('courses.add');
    Route::post('/courses/store', 'CourseController@store')->name('courses.store');
    Route::get('/courses/edit/{id}', 'CourseController@courseEdit')->name('courses.edit'); 
    Route::post('/courses/update', 'CourseController@update')->name('courses.update'); 
    Route::get('/users', 'UserController@listUsers')->name('users.index');
    Route::get('/users/add', 'UserController@addUsers')->name('users.add');
    Route::get('/banners', 'BannerController@listBanners')->name('banners.index');
    Route::get('/banners/add', 'BannerController@addBanners')->name('banners.add');
    Route::post('/banners/store', 'BannerController@store')->name('banners.store');
    Route::get('/blogs', 'BlogController@index')->name('blogs.index'); 
    Route::get('/blogs/add', 'BlogController@add')->name('blogs.add');
    Route::post('/blogs/store', 'BlogController@store')->name('blogs.store');
    Route::get('/blogs/edit/{id}', 'BlogController@blogEdit')->name('blogs.edit'); 
    Route::post('/blogs/update', 'BlogController@update')->name('blogs.update'); 
    Route::get('/leads', 'LeadController@index')->name('leads.index'); 
    Route::get('/leads/add', 'LeadController@add')->name('leads.add');
    Route::post('/leads/store', 'LeadController@store')->name('leads.store');
    Route::get('/leads/edit/{id}', 'LeadController@leadEdit')->name('leads.edit'); 
    Route::post('/leads/update', 'LeadController@update')->name('leads.update'); 
});



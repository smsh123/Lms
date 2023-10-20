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
Route::post('/cms/users/store', 'UserController@register');


/* home top navigation router */
Route::get('/course', 'CourseController@listing');
Route::get('/blogs', 'BlogController@listing');
Route::get('/success-stories', 'TestimonialController@listing');

/* all user profile router */
Route::get('/profile/{userid}', 'ProfileController@profile');
Route::get('/courses/{userid}', 'ProfileController@courses');
Route::get('/orders/{userid}', 'ProfileController@orders');
Route::get('/reports/{userid}', 'ProfileController@reports');
/* All cms routes */
Route::prefix('cms')->middleware(['internal'])->group(function () {
    Route::get('/', 'DashboardController@index'); 
    Route::get('/courses', 'CourseController@index')->name('courses.index'); 
    Route::get('/courses/add', 'CourseController@add')->name('courses.add');
    Route::post('/courses/store', 'CourseController@store')->name('courses.store');
    Route::get('/users', 'UserController@listUsers'); 
    Route::get('/users/add', 'UserController@addUsers'); 
});



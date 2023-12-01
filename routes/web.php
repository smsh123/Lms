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
Route::get('/course/{slug}', 'CourseController@courseDetails');
Route::get('/blogs', 'BlogController@listing');
Route::get('/success-stories', 'TestimonialController@listing');
Route::get('/pages', 'PageController@listing')->name('page.listing'); 
Route::get('/pages/{slug}', 'PageController@pageBySlug')->name('page.index'); 
Route::post('reset_password_without_token', 'AuthController@validatePasswordRequest');
Route::post('reset_password_with_token', 'AuthController@resetPassword');
Route::get('/reset/password/{token}', 'AuthController@resetPasswordForm');
Route::post('/image-upload-post','ImageUploadController@imageUploadPost');
Route::get('/get-course-module','SchedulingController@getModulesByCourse');
Route::get('/get-course-submodule','SchedulingController@getSubModulesByModuleId');

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
    Route::post('/users/store', 'UserController@register')->name('users.register');
    Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
    Route::post('/users/update', 'UserController@update')->name('users.update');
    Route::get('/users/permissions/{id}', 'UserController@userRolesPermissions')->name('users.userRolesPermissions');
    Route::post('/users/permissions-store', 'UserController@storeUserRolesPermissions')->name('users.storeUserRolesPermissions');
    Route::get('/banners', 'BannerController@listBanners')->name('banners.index');
    Route::get('/banners/add', 'BannerController@addBanners')->name('banners.add');
    Route::post('/banners/store', 'BannerController@store')->name('banners.store');
    Route::get('/blogs', 'BlogController@index')->name('blogs.index'); 
    Route::get('/blogs/add', 'BlogController@add')->name('blogs.add');
    Route::post('/blogs/store', 'BlogController@store')->name('blogs.store');
    Route::get('/blogs/edit/{id}', 'BlogController@blogEdit')->name('blogs.edit'); 
    Route::post('/blogs/update', 'BlogController@update')->name('blogs.update'); 
    Route::get('/menus', 'MenuController@index')->name('menus.index'); 
    Route::get('/menus/add', 'MenuController@add')->name('menus.add');
    Route::post('/menus/store', 'MenuController@store')->name('menus.store');
    Route::get('/leads', 'LeadController@index')->name('leads.index'); 
    Route::get('/leads/add', 'LeadController@add')->name('leads.add');
    Route::post('/leads/store', 'LeadController@store')->name('leads.store');
    Route::get('/leads/edit/{id}', 'LeadController@leadEdit')->name('leads.edit'); 
    Route::post('/leads/update', 'LeadController@update')->name('leads.update'); 
    Route::get('/testimonials', 'TestimonialController@index')->name('testimonial.index'); 
    Route::get('/testimonials/add', 'TestimonialController@add')->name('testimonial.add');
    Route::post('/testimonials/store', 'TestimonialController@store')->name('testimonial.store');
    Route::get('/testimonials/edit/{id}', 'TestimonialController@testimonialEdit')->name('testimonial.edit');
    Route::post('/testimonials/update', 'TestimonialController@update')->name('testimonial.update');
    Route::get('/pages', 'PageController@index')->name('pages.index'); 
    Route::get('/pages/add', 'PageController@add')->name('pages.add');
    Route::post('/pages/store', 'PageController@store');
    Route::get('/pages/edit/{id}', 'PageController@testimonialEdit')->name('pages.edit');
    Route::post('/pages/update', 'PageController@update')->name('pages.update');
    Route::get('/modules', 'ModuleController@index')->name('modules.index'); 
    Route::get('/modules/add', 'ModuleController@add')->name('modules.add');
    Route::post('/modules/store', 'ModuleController@store');
    Route::get('/modules/edit/{id}', 'ModuleController@edit')->name('modules.edit');
    Route::post('/modules/update', 'ModuleController@update')->name('modules.update'); 
    Route::get('/faq', 'FaqController@index')->name('faq.index'); 
    Route::get('/faq/add', 'FaqController@add')->name('faq.add');
    Route::post('/faq/store', 'FaqController@store');
    Route::get('/faq/edit/{id}', 'FaqController@edit')->name('faq.edit');
    Route::post('/faq/update', 'FaqController@update')->name('faq.update');
    Route::get('/mappings', 'MappingController@listing');
    Route::get('/course-module-mapping', 'CourseModuleMappingController@index');
    Route::get('/course-module-mapping/add', 'CourseModuleMappingController@add');
    Route::get('/course-module-mapping/edit/{id}', 'CourseModuleMappingController@edit');
    Route::post('/course-module-mapping/store', 'CourseModuleMappingController@store');
    Route::post('/course-module-mapping/update', 'CourseModuleMappingController@update');
    Route::get('/course-faq-mapping', 'CourseFaqMappingController@index');
    Route::get('/course-faq-mapping/add', 'CourseFaqMappingController@add');
    Route::get('/course-faq-mapping/edit/{id}', 'CourseFaqMappingController@edit');
    Route::post('/course-faq-mapping/store', 'CourseFaqMappingController@store');
    Route::post('/course-faq-mapping/update', 'CourseFaqMappingController@update');
    Route::get('/course-testimonial-mapping', 'CourseTestimonialMappingController@index');
    Route::get('/course-testimonial-mapping/add', 'CourseTestimonialMappingController@add');
    Route::get('/course-testimonial-mapping/edit/{id}', 'CourseTestimonialMappingController@edit');
    Route::post('/course-testimonial-mapping/store', 'CourseTestimonialMappingController@store');
    Route::post('/course-testimonial-mapping/update', 'CourseTestimonialMappingController@update');
    Route::get('/roles', 'RoleController@index');
    Route::get('/roles/add', 'RoleController@add');
    Route::get('/roles/edit/{id}', 'RoleController@edit');
    Route::get('/roles/delete/{id}', 'RoleController@delete');
    Route::post('/roles/store', 'RoleController@store');
    Route::get('/permissions', 'PermissionController@index');
    Route::get('/permissions/add', 'PermissionController@add');
    Route::get('/permissions/edit/{id}', 'PermissionController@edit');
    Route::get('/permissions/delete/{id}', 'PermissionController@delete');
    Route::post('/permissions/store', 'PermissionController@store');
    Route::get('/coupons', 'CouponController@index')->name('coupons.index'); 
    Route::get('/coupons/add', 'CouponController@add')->name('coupons.add');
    Route::post('/coupons/store', 'CouponController@store');
    Route::get('/coupons/edit/{id}', 'CouponController@couponEdit')->name('coupons.edit');
    Route::post('/coupons/update', 'CouponController@update')->name('coupons.update');
    Route::get('/schedule', 'SchedulingController@index')->name('schedule.index'); 
    Route::get('/schedule/add', 'SchedulingController@add')->name('schedule.add');
    Route::post('/schedule/store', 'SchedulingController@store')->name('schedule.store');
    Route::get('/schedule/edit/{id}', 'SchedulingController@scheduleEdit')->name('schedule.edit'); 
    Route::post('/schedule/update', 'SchedulingController@update')->name('schedule.update'); 
});



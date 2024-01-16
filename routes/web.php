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
Route::get('/contact-us', 'HomeController@contact');
Route::post('/leads/store', 'LeadController@store');
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::get('/profile/{id}', 'ProfileController@profile');
Route::get('/edit-profile/{id}', 'ProfileController@editProfile');
Route::get('/support/{id}', 'ProfileController@getSupport');
Route::post('/profile/update', 'ProfileController@profileUpdate');
Route::get('/my-courses/{id}', 'ProfileController@courses');
Route::get('/orders/{id}', 'ProfileController@orders');
Route::get('/reports/{id}', 'ProfileController@reports');
Route::get('/course', 'CourseController@listing');
Route::get('/course/{slug}', 'CourseController@courseDetails');
Route::get('/blogs', 'BlogController@listing');
Route::get('/tags/{tag}', 'TagController@index');
Route::get('/blogs/{slug}', 'BlogController@blogDetails');
Route::get('/success-stories', 'TestimonialController@listing');
Route::get('/pages', 'PageController@listing')->name('page.listing');
Route::get('/pages/{slug}', 'PageController@pageBySlug')->name('page.index');
Route::post('reset_password_without_token', 'AuthController@validatePasswordRequest');
Route::post('reset_password_with_token', 'AuthController@resetPassword');
Route::get('/reset/password/{token}', 'AuthController@resetPasswordForm');
Route::post('/image-upload-post', 'ImageUploadController@imageUploadPost');
Route::get('/get-course-module', 'SchedulingController@getModulesByCourse');
Route::get('/get-course-submodule', 'SchedulingController@getSubModulesByModuleId');

Route::get('/cart/{slug}', 'OrderController@addToCart');
Route::post('/orders/store', 'OrderController@store');
Route::post('/orders/update', 'OrderController@update');
Route::post('/apply-coupon/{coupon}', 'OrderController@applyCoupon');
Route::any('/make-payment', 'OrderController@paymentProcess');
// Route::get('/razorpay/create-order', 'RazorpayController@initiatePayment');
Route::any('/razorpay/initiate-payment', 'RazorpayController@initiatePayment');
Route::any('/order/success', 'OrderController@success')->name('order.success');
Route::any('/order/fail', 'OrderController@fail')->name('order.fail');
Route::post('/razorpay/payment-callback', 'RazorpayController@paymentCallback');
Route::get('auth/google', 'GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'GoogleController@handleGoogleCallback');

/* All cms routes */
Route::prefix('cms')->middleware(['internal'])->group(function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/brands', 'BrandController@index')->name('brands.index');
    Route::get('/brands/add', 'BrandController@add')->name('brands.add');
    Route::post('/brands/store', 'BrandController@store')->name('brands.store');
    Route::get('/brands/edit/{id}', 'BrandController@edit')->name('brands.edit');
    Route::get('/brands/delete/{id}', 'BrandController@destroy')->name('brands.delete');
    Route::post('/brands/update', 'BrandController@update')->name('brands.update');
    Route::get('/categories', 'CategoryController@index')->name('categories.index');
    Route::get('/categories/add', 'CategoryController@add')->name('categories.add');
    Route::post('/categories/store', 'CategoryController@store')->name('categories.store');
    Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
    Route::get('/categories/delete/{id}', 'CategoryController@destroy')->name('categories.delete');
    Route::post('/categories/update', 'CategoryController@update')->name('categories.update');
    Route::get('/tools', 'ToolsController@index')->name('tools.index');
    Route::get('/tools/add', 'ToolsController@add')->name('tools.add');
    Route::post('/tools/store', 'ToolsController@store')->name('tools.store');
    Route::get('/tools/edit/{id}', 'ToolsController@edit')->name('tools.edit');
    Route::get('/tools/delete/{id}', 'ToolsController@destroy')->name('tools.delete');
    Route::post('/tools/update', 'ToolsController@update')->name('tools.update');
    Route::get('/courses', 'CourseController@index')->name('courses.index');
    Route::get('/courses/add', 'CourseController@add')->name('courses.add');
    Route::post('/courses/store', 'CourseController@store')->name('courses.store');
    Route::get('/courses/edit/{id}', 'CourseController@courseEdit')->name('courses.edit');
    Route::get('/courses/delete/{id}', 'CourseController@destroy')->name('courses.delete');
    Route::post('/courses/update', 'CourseController@update')->name('courses.update');
    Route::get('/users', 'UserController@listUsers')->name('users.index');
    Route::get('/users/add', 'UserController@addUsers')->name('users.add');
    Route::post('/users/store', 'UserController@register')->name('users.register');
    Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
    Route::get('/users/delete/{id}', 'UserController@destroy')->name('users.delete');
    Route::post('/users/update', 'UserController@update')->name('users.update');
    Route::get('/users/permissions/{id}', 'UserController@userRolesPermissions')->name('users.userRolesPermissions');
    Route::post('/users/permissions-store', 'UserController@storeUserRolesPermissions')->name('users.storeUserRolesPermissions');
    Route::get('/banners', 'BannerController@listBanners')->name('banners.index');
    Route::get('/banners/add', 'BannerController@addBanners')->name('banners.add');
    Route::post('/banners/store', 'BannerController@store')->name('banners.store');
    Route::post('/banners/delete/{id}', 'BannerController@destroy')->name('banners.delete');
    Route::get('/blogs', 'BlogController@index')->name('blogs.index');
    Route::get('/blogs/add', 'BlogController@add')->name('blogs.add');
    Route::post('/blogs/store', 'BlogController@store')->name('blogs.store');
    Route::get('/blogs/edit/{id}', 'BlogController@blogEdit')->name('blogs.edit');
    Route::get('/blogs/delete/{id}', 'BlogController@destroy')->name('blogs.delete');
    Route::post('/blogs/update', 'BlogController@update')->name('blogs.update');
    Route::get('/menus', 'MenuController@index')->name('menus.index');
    Route::get('/menus/add', 'MenuController@add')->name('menus.add');
    Route::get('/menus/edit/{id}', 'MenuController@edit')->name('menus.edit');
    Route::get('/menus/delete/{id}', 'MenuController@destroy')->name('menus.delete');
    Route::post('/menus/update', 'MenuController@update')->name('menus.update');
    Route::post('/menus/store', 'MenuController@store')->name('menus.store');
    Route::get('/leads', 'LeadController@index')->name('leads.index');
    Route::get('/leads/add', 'LeadController@add')->name('leads.add');
    Route::post('/leads/store', 'LeadController@store')->name('leads.store');
    Route::get('/leads/edit/{id}', 'LeadController@leadEdit')->name('leads.edit');
    Route::get('/leads/delete/{id}', 'LeadController@destroy')->name('leads.delete');
    Route::post('/leads/update', 'LeadController@update')->name('leads.update');
    Route::get('/testimonials', 'TestimonialController@index')->name('testimonial.index');
    Route::get('/testimonials/add', 'TestimonialController@add')->name('testimonial.add');
    Route::post('/testimonials/store', 'TestimonialController@store')->name('testimonial.store');
    Route::get('/testimonials/edit/{id}', 'TestimonialController@testimonialEdit')->name('testimonial.edit');
    Route::get('/testimonials/delete/{id}', 'TestimonialController@destroy')->name('testimonial.delete');
    Route::post('/testimonials/update', 'TestimonialController@update')->name('testimonial.update');
    Route::get('/pages', 'PageController@index')->name('pages.index');
    Route::get('/pages/add', 'PageController@add')->name('pages.add');
    Route::post('/pages/store', 'PageController@store');
    Route::get('/pages/edit/{id}', 'PageController@testimonialEdit')->name('pages.edit');
    Route::get('/pages/delete/{id}', 'PageController@destroy')->name('pages.delete');
    Route::post('/pages/update', 'PageController@update')->name('pages.update');
    Route::get('/modules', 'ModuleController@index')->name('modules.index');
    Route::get('/modules/add', 'ModuleController@add')->name('modules.add');
    Route::post('/modules/store', 'ModuleController@store');
    Route::get('/modules/edit/{id}', 'ModuleController@edit')->name('modules.edit');
    Route::get('/modules/delete/{id}', 'ModuleController@destroy')->name('modules.delete');
    Route::post('/modules/update', 'ModuleController@update')->name('modules.update');
    Route::get('/faq', 'FaqController@index')->name('faq.index');
    Route::get('/faq/add', 'FaqController@add')->name('faq.add');
    Route::post('/faq/store', 'FaqController@store');
    Route::get('/faq/edit/{id}', 'FaqController@edit')->name('faq.edit');
    Route::get('/faq/delete/{id}', 'FaqController@destroy')->name('faq.delete');
    Route::post('/faq/update', 'FaqController@update')->name('faq.update');
    Route::get('/mappings', 'MappingController@listing')->name('mapping.index');
    Route::get('/course-module-mapping', 'CourseModuleMappingController@index');
    Route::get('/course-module-mapping/add', 'CourseModuleMappingController@add');
    Route::get('/course-module-mapping/edit/{id}', 'CourseModuleMappingController@edit');
    Route::get('/course-module-mapping/delete/{id}', 'CourseModuleMappingController@destroy');
    Route::post('/course-module-mapping/store', 'CourseModuleMappingController@store');
    Route::post('/course-module-mapping/update', 'CourseModuleMappingController@update');
    Route::get('/course-faq-mapping', 'CourseFaqMappingController@index');
    Route::get('/course-faq-mapping/add', 'CourseFaqMappingController@add');
    Route::get('/course-faq-mapping/edit/{id}', 'CourseFaqMappingController@edit');
    Route::get('/course-faq-mapping/delete/{id}', 'CourseFaqMappingController@destroy');
    Route::post('/course-faq-mapping/store', 'CourseFaqMappingController@store');
    Route::post('/course-faq-mapping/update', 'CourseFaqMappingController@update');
    Route::get('/course-testimonial-mapping', 'CourseTestimonialMappingController@index');
    Route::get('/course-testimonial-mapping/add', 'CourseTestimonialMappingController@add');
    Route::get('/course-testimonial-mapping/edit/{id}', 'CourseTestimonialMappingController@edit');
    Route::get('/course-testimonial-mapping/delete/{id}', 'CourseTestimonialMappingController@destroy')->name('course.delete');
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
    Route::get('/coupons/delete/{id}', 'CouponController@destroy')->name('coupons.delete');
    Route::post('/coupons/update', 'CouponController@update')->name('coupons.update');
    Route::get('/schedule', 'SchedulingController@index')->name('schedule.index');
    Route::get('/schedule/add', 'SchedulingController@add')->name('schedule.add');
    Route::post('/schedule/store', 'SchedulingController@store')->name('schedule.store');
    Route::get('/schedule/edit/{id}', 'SchedulingController@scheduleEdit')->name('schedule.edit');
    Route::post('/schedule/update', 'SchedulingController@update')->name('schedule.update');
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/add', 'OrderController@add')->name('orders.add');
    Route::post('/orders/store', 'OrderController@store')->name('orders.store');
    Route::get('/orders/edit/{id}', 'OrderController@edit')->name('orders.edit');
    Route::post('/orders/update', 'OrderController@update')->name('orders.update');
    Route::get('/subscriptions', 'SubscriptionController@index')->name('subscriptions.index');
    Route::get('/subscriptions/edit/{id}', 'SubscriptionController@edit')->name('subscriptions.edit');
    Route::post('/subscriptions/update', 'SubscriptionController@update')->name('subscriptions.update');
    Route::get('/sections', 'SectionController@index')->name('sections.index');
    Route::get('/sections/add', 'SectionController@add')->name('sections.add');
    Route::get('/sections/edit/{id}', 'SectionController@edit')->name('sections.edit');
    Route::get('/sections/delete/{id}', 'SectionController@destroy')->name('sections.delete');
    Route::post('/sections/update', 'SectionController@update')->name('sections.update');
    Route::post('/sections/store', 'SectionController@store')->name('sections.store');
    Route::get('/blocks', 'BlockController@index')->name('blocks.index');
    Route::get('/blocks/add', 'BlockController@add')->name('blocks.add');
    Route::get('/blocks/edit/{id}', 'BlockController@edit')->name('blocks.edit');
    Route::get('/blocks/delete/{id}', 'BlockController@destroy')->name('blocks.delete');
    Route::post('/blocks/update', 'BlockController@update')->name('blocks.update');
    Route::post('/blocks/store', 'BlockController@store')->name('blocks.store');
});

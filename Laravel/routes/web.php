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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/events', 'HomeController@events')->name('event');
Route::get('/services', 'HomeController@services')->name('service');
Route::get('/event/{slug}', 'HomeController@event_detail')->name('event.detail');
Route::get('/service/{slug}', 'HomeController@service_detail')->name('service.detail');
Route::get('/booking/service/{id}', 'HomeController@service_booking')->name('service.booking');
Route::get('/booking/event/{id}', 'HomeController@event_booking')->name('event.booking');
Route::post('/booking/save', 'HomeController@booking')->name('booking.save');
Route::get('/booking/payment/{id}', 'HomeController@payment')->name('booking.pay');
Route::post('/booking/payment/{id}/save', 'HomeController@makePayment')->name('booking.payment');

Route::prefix('admin/')->middleware(['auth', 'isAdmin'])->name('admin.')->namespace('Admin')->group(function () {
    Route::get('/dashboard', 'Dashboard@index')->name('dashaboard');

    // Events
    Route::get('/events', 'Events@index')->name('events');
    Route::get('/events/new', 'Events@create')->name('events.new');
    Route::post('/events/save', 'Events@store')->name('events.save');
    Route::get('/events/edit/{id}', 'Events@edit')->name('events.edit');
    Route::post('/events/update/{id}', 'Events@update')->name('events.update');
    Route::get('/events/delete/{id}', 'Events@destroy')->name('events.delete');

    // Services
    Route::get('/services', 'Services@index')->name('services');
    Route::get('/services/new', 'Services@create')->name('services.new');
    Route::post('/services/save', 'Services@store')->name('services.save');
    Route::get('/services/edit/{id}', 'Services@edit')->name('services.edit');
    Route::post('/services/update/{id}', 'Services@update')->name('services.update');
    Route::get('/services/delete/{id}', 'Services@destroy')->name('services.delete');


    Route::get('/categories', 'Categories@index')->name('categories');
    Route::post('/categories/save', 'Categories@store')->name('categories.save');
    Route::get('/categories/edit/{id}', 'Categories@edit')->name('categories.edit');
    Route::post('/categories/update/{id}', 'Categories@update')->name('categories.update');
    Route::get('/categories/delete/{id}', 'Categories@destroy')->name('categories.delete');

    //Booking Routes
    Route::get('/bookings', 'Bookings@index')->name('bookings');
    Route::get('/bookings/view/{id}', 'Bookings@edit')->name('bookings.edit');

    Route::get('/transactions', 'Transactions@index')->name('transaction');

    Route::get('/users', 'Users@index')->name('users');
    Route::get('/users/send-reset-link/{id}', 'Users@sendLink')->name('user.send-reset-link');
    Route::get('/users/vendor/{id}', 'Users@makeVendor')->name('user.vendor');

    Route::get('/settings/change-password', 'Settings@changePassword')->name('password');
    Route::post('/settings/password', 'Settings@updatePassword')->name('change-password');

    Route::get('/settings/profile', 'Settings@profile')->name('profile');
    Route::post('/settings/profile/update', 'Settings@updateProfile')->name('profile.update');
});



Route::prefix('vendor/')->middleware(['auth', 'isUser'])->name('vendor.')->namespace('Vendor')->group(function () {
    Route::get('/dashboard', 'Dashboard@index')->name('dashboard');

    Route::get('/events', 'Events@index')->name('events');
    Route::get('/events/new', 'Events@create')->name('events.new');
    Route::post('/events/save', 'Events@store')->name('events.save');
    Route::get('/events/edit/{id}', 'Events@edit')->name('events.edit');
    Route::post('/events/update/{id}', 'Events@update')->name('events.update');
    Route::get('/events/delete/{id}', 'Events@destroy')->name('events.delete');

    // Services
    Route::get('/services', 'Services@index')->name('services');
    Route::get('/services/new', 'Services@create')->name('services.new');
    Route::post('/services/save', 'Services@store')->name('services.save');
    Route::get('/services/edit/{id}', 'Services@edit')->name('services.edit');
    Route::post('/services/update/{id}', 'Services@update')->name('services.update');
    Route::get('/services/delete/{id}', 'Services@destroy')->name('services.delete');



    Route::get('/settings/change-password', 'Settings@changePassword')->name('password');
    Route::post('/settings/password', 'Settings@updatePassword')->name('change-password');

    Route::get('/settings/profile', 'Settings@profile')->name('profile');
    Route::post('/settings/profile/update', 'Settings@updateProfile')->name('profile.update');

    //Booking Routes
    Route::get('/bookings', 'Bookings@index')->name('bookings');
    Route::get('/bookings/view/{id}', 'Bookings@edit')->name('bookings.edit');
});

require __DIR__ . '/auth.php';

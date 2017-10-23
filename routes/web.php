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
    return redirect()->route('login');
});

Auth::routes();

Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

Route::resource('auxiliary/category', 'CategoryController');
Route::resource('auxiliary/priority', 'PriorityController');
Route::resource('ticket', 'TicketController');

// User
Route::get('profile', 'UserController@profile')->name('user.profile');
Route::put('profile/update', 'UserController@profileUpdate')->name('user.profileUpdate');
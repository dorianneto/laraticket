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

Route::prefix('auxiliary')->group(function() {
    // Categorias
    Route::resource('category', 'CategoryController');

    // Prioridades
    Route::resource('priority', 'PriorityController');
});

// Ticket
Route::resource('ticket', 'TicketController');
Route::get('report/create', 'TicketController@report')->name('ticket.report');
Route::post('report', 'TicketController@storeReport')->name('ticket.storeReport');

// User
Route::get('profile', 'UserController@profile')->name('user.profile');
Route::put('profile/update', 'UserController@profileUpdate')->name('user.profileUpdate');
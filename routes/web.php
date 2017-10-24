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
Route::get('ticket', 'TicketController@index')->name('ticket.index');
Route::get('ticket/archive', 'TicketController@archive')->name('ticket.archive');
Route::post('ticket/archive/{id}', 'TicketController@archivePost')->name('ticket.archivePost');
Route::post('ticket/restore/{id}', 'TicketController@restore')->name('ticket.restore');
Route::delete('ticket/{id}', 'TicketController@destroy')->name('ticket.destroy');
Route::get('ticket/{id}', 'TicketController@show')->name('ticket.show');
Route::get('ticket/room/{id}', 'TicketController@room')->name('ticket.room');
Route::post('ticket/room/{id}', 'TicketController@roomPost')->name('ticket.roomPost');
Route::get('report/create', 'TicketController@report')->name('ticket.report');
Route::post('report', 'TicketController@reportPost')->name('ticket.reportPost');

// User
Route::get('profile', 'UserController@profile')->name('user.profile');
Route::put('profile/update', 'UserController@profileUpdate')->name('user.profileUpdate');
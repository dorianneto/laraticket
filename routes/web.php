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

Route::prefix('auxiliary')->middleware('can:see-auxiliares')->group(function() {
    // Categorias
    Route::resource('category', 'CategoryController');

    // Prioridades
    Route::resource('priority', 'PriorityController');
});

// Ticket
Route::match(['get', 'post'], 'ticket', 'TicketController@index')->name('ticket.index')->middleware('can:list-ticket');
Route::get('ticket/archive', 'TicketController@archive')->name('ticket.archive')->middleware('can:delete-ticket');
Route::post('ticket/archive/{id}', 'TicketController@archivePost')->name('ticket.archivePost')->middleware('can:delete-ticket');
Route::post('ticket/restore/{id}', 'TicketController@restore')->name('ticket.restore')->middleware('can:delete-ticket');
Route::delete('ticket/{id}', 'TicketController@destroy')->name('ticket.destroy')->middleware('can:delete-ticket');
Route::get('ticket/room/{id}', 'TicketController@room')->name('ticket.room')->middleware('can:show-ticket');
Route::post('ticket/room/{id}', 'TicketController@roomPost')->name('ticket.roomPost')->middleware('can:show-ticket');
Route::get('report/create', 'TicketController@report')->name('ticket.report')->middleware('can:create-ticket');
Route::post('report', 'TicketController@reportPost')->name('ticket.reportPost')->middleware('can:create-ticket');

// User
Route::get('profile', 'UserController@profile')->name('user.profile')->middleware('can:edit-profile');
Route::put('profile/update', 'UserController@profileUpdate')->name('user.profileUpdate')->middleware('can:edit-profile');
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

Route::get('/', 'HomeController@index');

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.layout.index');
    });

    Route::resource('theaters', 'TheaterController')->except(['show']);
    Route::resource('ticketprices', 'TicketPriceController')->except(['show']);
    Route::resource('rooms', 'RoomController')->except(['show']);
    Route::resource('films', 'FilmController')->except(['show']);
    Route::resource('comments', 'CommentController');
    Route::resource('calendars', 'CalendarController')->except(['show']);
    Route::resource('news', 'NewController');
    Route::resource('users', 'UserController')->middleware('checkLevel');
    Route::resource('customer', 'CustomerController')->middleware('checkLevel');

    //ajax
    Route::get('calendars/ajaxRoom/{theater_id}', 'CalendarController@ajaxRoom');
});

Route::get('theaters', 'TheaterController@show');
Route::get('ajaxTheater/{id}', 'TheaterController@ajaxShow');

//Calendar
Route::get('calendars/{id}', 'CalendarController@show');
Route::get('ajaxCalendar/{id}', 'CalendarController@ajaxShow');

//news
Route::get('news', 'NewController@news')->name('news');
Route::get('news-detail/{id}', 'NewController@newsDetail')->name('newsDetail');

//promotions
Route::get('promotions', 'NewController@promotions')->name('promotions');
Route::get('promotion-detail/{id}', 'NewController@promotionDetail')->name('promotionDetail');
Route::get('theater', 'TheaterController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::get('booking-tickets/{calTime}', 'BookingTickets@getBookTicket')->middleware('login');
Route::post('booking-tickets/{calTime}', 'BookingTickets@postBookTicket');

Route::get('user', 'UserController@user')->name('user');

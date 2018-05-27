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
    return view('welcome');
});

Auth::routes();
/*
|--------------------------------------------------------------------------
| 1) User 認証不要
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return redirect('/home'); });
 
/*
|--------------------------------------------------------------------------
| 2) User ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth:user'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('reservations', 'ReservationsController@index')->name('reservations.index');
    Route::get('reservations/getIndex', 'ReservationsController@getIndex')->name('reservations.getIndex');
    Route::get('reservations/{id}', 'ReservationsController@show')->name('reservations.show');
    Route::get('reservations/{id}/edit', 'ReservationsController@edit')->name('reservations.edit');
    Route::post('reservations','ReservationsController@store')->name('reservations.store');
    Route::put('reservations/{id}', 'ReservationsController@update')->name('reservations.update');
    Route::delete('reservations/{id}', 'ReservationsController@destroy')->name('reservations.destroy');
    
});
 
/*
|--------------------------------------------------------------------------
| 3) Admin 認証不要
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {
    Route::get('/',function () { return redirect('/admin/home'); });
    Route::get('login','Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login','Admin\LoginController@login');
});
 
/*
|--------------------------------------------------------------------------
| 4) Admin ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::post('logout','Admin\LoginController@logout')->name('admin.logout');
    Route::get('home','Admin\HomeController@index')->name('admin.home');
    Route::resource('users', 'UsersController');
    Route::resource('rooms', 'RoomsController');
});

Route::get('/admin/home', 'Admin\HomeController@index')->name('home');

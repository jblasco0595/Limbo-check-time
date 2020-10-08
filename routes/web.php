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
Route::get('checkPage', 'CheckController@index')->name('check');
Route::get('startNewTime', 'CheckController@startTime')->name('start');
Route::get('endTimeRecord', 'CheckController@endTime')->name('end');
Route::get('/home', 'HomeController@index')->name('home');
Route::put('/timeRange/{timeRange}', 'CheckController@update')->name('updateTimeRange');
Route::get('settingsPage', 'SettingsController@index')->name('settings');
Route::post('settingsPage', 'SettingsController@store')->name('settingsStore');
Auth::routes(['register' => false]);

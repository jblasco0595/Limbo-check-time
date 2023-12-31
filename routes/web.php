<?php

use Illuminate\Support\Facades\Log;

$proxy_url    = env('PROXY_URL');
$proxy_schema = env('PROXY_SCHEMA');

if (!empty($proxy_url)) {
   URL::forceRootUrl($proxy_url);
}

if (!empty($proxy_schema)) {
    URL::forceScheme($proxy_schema);
}


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







// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------
//                                                    Home CONTROLLER                                                   **
// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------


Route::get('/home', 'HomeController@index')->name('home');


// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------
//                                                    CHECK CONTROLLER                                                 **
// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------

Route::get('checkPage', 'CheckController@index')->name('check');

Route::get('startNewTime', 'CheckController@startTime')->name('start');

Route::get('endTimeRecord', 'CheckController@endTime')->name('end');

Route::put('/timeRange/{timeRange}', 'CheckController@update')->name('updateTimeRange');

Route::get('closeAllRanges', 'CheckController@closeAllRanges')->name('closeAllRanges');


// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------
//                                                    SETTING CONTROLLER                                                 **
// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------

Route::get('settingsPage', 'SettingsController@index')->name('settings');

Route::post('settingsPage', 'SettingsController@store')->name('settingsStore');



// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------
//                                                    EXTRATIME CONTROLLER                                               **
// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------

Route::get('extratimePage', 'ExtraTimeController@index')->name('extraTime');

Route::post('extratime', 'ExtraTimeController@store')->name('extraTime.store');

Route::put('extratime/{extraTime}', 'ExtraTimeController@update')->name('extraTime.update');

Route::put('extratime/{extraTime}/approved', 'ExtraTimeController@approved')->name('extraTime.approved');

Route::delete('extratime/{extraTime}', 'ExtraTimeController@destroy')->name('extraTime.destroy');


// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------
//                                                    PROJECT CONTROLLER                                                 **
// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------

Route::get('projectsPage', 'ProjectsController@index')->name('projects');

Route::post('projectsPage', 'ProjectsController@store')->name('projects.store');

Route::delete('projectsPage/{project}', 'ProjectsController@destroy')->name('projects.destroy');

Route::put('projectsPage/{project}/update', 'ProjectsController@update')->name('projects.update');


// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------
//                                                    PROJECT PAYMENT CONTROLLER                                         **
// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------

Route::get('projectsPaymentPage', 'ProjectPaymentController@index')->name('projectsPayment');

Route::post('projectsPayment', 'ProjectPaymentController@store')->name('projectsPayment.store');

Route::put('projectsPayment/{projectPayment}/update', 'ProjectPaymentController@update')->name('projectsPayment.update');

Route::delete('projectsPayment/{projectPayment}', 'ProjectPaymentController@destroy')->name('projectsPayment.destroy');


// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------
//                                                    LIMBOCOINS CONTROLLER                                         **
// ------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------


Route::get('limbocoinsPage', 'LimbocoinsMoveController@index')->name('limbocoinsMove');

Route::post('limbocoinsPage', 'LimbocoinsMoveController@store')->name('limbocoinsMove.store');

Route::put('limbocoinsPage/{LimbocoinsMove}/update', 'LimbocoinsMoveController@update')->name('limbocoinsMove.update');

Route::delete('limbocoinsPage/{LimbocoinsMove}', 'LimbocoinsMoveController@destroy')->name('limbocoinsMove.destroy');

Auth::routes(['register' => false]);
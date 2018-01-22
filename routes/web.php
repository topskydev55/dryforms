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

//Auth::routes();

Route::middleware(['auth'])->prefix('admin')->group(function() {
    Route::resource('users', 'Backend\UsersController');
    Route::resource('plans', 'Backend\PlansController');
    Route::resource('coupons', 'Backend\CouponsController');

    Route::resource('units-of-measure', 'Backend\UnitsOfMeasureController');
});

Route::middleware([])->namespace('Frontend')->group(function() {
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'main.index']);
});
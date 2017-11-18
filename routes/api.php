<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('login', 'Auth\ApiAuthController@login');
    Route::post('logout', 'Auth\ApiAuthController@logout');
    Route::post('refresh', 'Auth\ApiAuthController@refresh');
    Route::post('me', 'Auth\ApiAuthController@me');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->middleware(['auth:api'])->group(function() {
    Route::resource('categories', 'EquipmentCategoriesController');
    Route::resource('models', 'EquipmentModelsController');
    Route::resource('teams', 'EquipmentTeamsController');
    Route::resource('statuses', 'EquipmentStatusesController');
    Route::resource('equipments', 'EquipmentsController');
    Route::delete('equipments-bulk-delete', 'EquipmentsController@bulkDestroy');
    Route::get('get-models/{id}', 'EquipmentCategoriesController@getModels');
    Route::resource('companies', 'CompaniesController');
    Route::resource('employee-statuses', 'EmployeeStatusesController');
    Route::resource('company-employees', 'CompanyEmployeesController');
});

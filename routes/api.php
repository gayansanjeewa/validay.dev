<?php

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

//Route::middleware('auth:api')->group(function () {
Route::group(['prefix' => 'department'], function () {
    Route::post('/', 'DepartmentController@create');

    Route::post('/attach', 'DepartmentController@attach');

    Route::get('/{department}/employees', 'DepartmentController@employees');
});

Route::group(['prefix' => 'employee'], function () {
    Route::post('/', 'EmployeeController@create');
});
//});

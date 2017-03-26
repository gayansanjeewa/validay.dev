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

Route::middleware('jwt.auth')->group(function () {
    Route::group(['prefix' => 'department'], function () {
        Route::post('/', 'DepartmentController@create');

        Route::post('/attach', 'DepartmentController@attach');

        Route::get('/{department}/employees', 'DepartmentController@employees');

        Route::get('/all', 'DepartmentController@all');
    });

    Route::group(['prefix' => 'employee'], function () {
        Route::post('/', 'EmployeeController@create');
    });
});

Route::post('/register', 'TokenAuthController@register');
Route::post('/authenticate', 'TokenAuthController@authenticate');
Route::get('/authenticate/user', 'TokenAuthController@getAuthenticatedUser');


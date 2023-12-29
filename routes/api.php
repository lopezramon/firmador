<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
require __DIR__.'/auth.php';


Route::get('organizations/validation/{rut}', 'App\Http\Controllers\API\OrganizationAPIController@getValidation');
Route::post('firms/register', 'App\Http\Controllers\API\FirmAPIController@setRegister');
Route::get('show', 'App\Http\Controllers\API\FirmAPIController@getShow');

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('users', App\Http\Controllers\API\UserAPIController::class);
    Route::resource('firms', App\Http\Controllers\API\FirmAPIController::class);
    // Route::resource('log-signaturs', App\Http\Controllers\API\LogSignaturAPIController::class);
    Route::resource('organizations', App\Http\Controllers\API\OrganizationAPIController::class);
    
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])
    ->name('logout');
});
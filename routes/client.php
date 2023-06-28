<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientVendorController;
use Illuminate\Support\Facades\Route;

Route::prefix('client_restricted')->group(function () {

    Route::post('loginClient', [ClientController::class, 'loginClient']);
    Route::post('forgetClientPin', [ClientController::class, 'forgetPin']);

    Route::group(['middleware' => ['auth:client,client-api']], function () {

        Route::controller(ClientVendorController::class)->group(function () {
            Route::post('client-create-vendor', 'createVendor');
            Route::get('get-client-vendors', 'getAllVendorsForAParticularClient');
            Route::get('get-single-vendor/{id}', 'getSingleVendor');
            Route::delete('delete-vendor/{id}', 'deleteVendors');
            Route::put('update-vendor/{id}', 'updateVendors');
        });

    });

});

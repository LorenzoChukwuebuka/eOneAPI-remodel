<?php

use App\Http\Controllers\Vendor\VendordAuthController;
use App\Http\Controllers\Vendor\VendordUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('vendor_restricted')->group(function () {

    Route::post('vendor-login', [VendordAuthController::class, 'login']);

    Route::group(['middleware' => ['auth:vendor,vendor-api']], function () {
       
    });

});

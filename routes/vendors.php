<?php

use App\Http\Controllers\Vendor\VendordAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('vendor_restricted')->group(function () {

    Route::post('vendor-login', [VendordAuthController::class, 'login']);

});

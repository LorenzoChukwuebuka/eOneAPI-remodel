<?php

use App\Http\Controllers\Client\ClientController;
use Illuminate\Support\Facades\Route;

Route::prefix('client_restricted')->group(function () {

    Route::post('loginClient', [ClientController::class, 'loginClient']);
    Route::post('forgetClientPin',[ClientController::class,'forgetPin']);

    // Route::group(['middleware' => ['auth:client,client-api']], function () {

    // });

});

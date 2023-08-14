<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Card\CardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Transanctions\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::group(['middleware' => ApiMiddleware::class], function () { */

Route::post('user-login', [UserController::class, 'login']);
Route::post('verify-user', [UserController::class, 'verify_user']);
Route::post('forget-password', [UserController::class, 'forgetPassword']);
Route::post('reset-password', [UserController::class, 'resetPassword']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::controller(PaymentController::class)->group(function () {
        Route::post('initialize-payment', 'initialize_payment');
        Route::get('verify-payment/{reference}', 'verify_payment');
        Route::post('fund-card', 'fund_card');
    });

    Route::post('create-update-transaction_pin', [UserController::class, 'createUpdateTransactionPin']);

  

});

require __DIR__ . '/admin.php';

require __DIR__ . '/client.php';

require __DIR__ . '/vendors.php';
//});

Route::fallback(function () {
    return response()->json([
        'code' => 404,
        'message' => 'Route Not Found',
    ], 404);
});

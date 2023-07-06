<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

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
Route::post('verify-user',[UserController::class,'verify_user']);



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

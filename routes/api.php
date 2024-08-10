<?php

use App\Http\Controllers\Api\Auth\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::prefix('auth')->group(function () {

    Route::prefix('user')->group(function () {

        // Route::get('info', [AuthApiController::class, 'signUpInfo']);

        Route::post('check/phone', [AuthApiController::class, 'checkUserPhone']);
        // Route::post('check/email', [AuthApiController::class, 'checkUserEmail']);

        Route::post('sign-up', [AuthApiController::class, 'signUp']);
        Route::post('log-in', [AuthApiController::class, 'logIn']);

        Route::post('send-otp', [AuthApiController::class, 'sendOtpCode']);
        Route::post('check-otp', [AuthApiController::class, 'checkOtpCode']);

        Route::post('forgot/password', [AuthApiController::class, 'sendForgetPasswordCode']);
        Route::post('check/code', [AuthApiController::class, 'checkForgetPasswordCode']);
        Route::post('update/password', [AuthApiController::class, 'setNewPassword']);

        Route::middleware('auth:user')->group(function () {

            Route::post('user', [AuthApiController::class, 'user']);
            Route::get('log-out', [AuthApiController::class, 'logOut']);

            // Route::post('forgot-password', [AuthApiController::class, 'forgotPassword']);

            Route::post('update-info', [AuthApiController::class, 'updateInfo']);
            // Route::post('update-password', [AuthApiController::class, 'updatePassword']);
            Route::post('change-number-1', [AuthApiController::class, 'chickNumberStep1']);
            Route::post('change-number-2', [AuthApiController::class, 'chickNumberStep2']);

            Route::get('delete/account', [AuthApiController::class, 'deleteAccount']);
        });
    });
});


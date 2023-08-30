<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/auth', [\App\Http\Controllers\AuthController::class, 'auth'])->name('auth');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/email/verification-notification', [\App\Http\Controllers\EmailVerificationController::class, 'send'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('/user', [\App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    });

    Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\EmailVerificationController::class, 'verify'])
        ->middleware(['auth-for-email', 'signed'])
        ->name('verification.verify');
});

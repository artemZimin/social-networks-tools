<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('vk')->group(function () {
    Route::middleware(['check-token-and-add-to-header', 'auth:sanctum'])->group(function () {
        Route::get('/auth', [\App\Http\Controllers\VkAuthController::class, 'index'])->name('vk.auth');
    });

    Route::get('/code', [\App\Http\Controllers\VkAuthController::class, 'code'])->name('vk.code');
});

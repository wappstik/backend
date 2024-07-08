<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PackController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route:: post('/login', LoginController::class)
        ->name('login');
    Route::post('/register', RegisterController::class)
            ->name('register');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', LogoutController::class);

    Route::apiResource('category', CategoryController::class);
    Route::apiResource('pack', PackController::class);
});
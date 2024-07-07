<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class);
Route::post('/logout', LogoutController::class);
Route::post('/register', RegisterController::class);

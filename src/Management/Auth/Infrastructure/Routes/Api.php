<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', AuthLoginController::class);
Route::post('/logout', AuthLogoutController::class);
Route::post('/singup', AuthSingUpController::class);
Route::post('/test', AuthPruebasController::class);

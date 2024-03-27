<?php

use Illuminate\Support\Facades\Route;


Route::get('/', PeopleGetController::class);
Route::post('/', PeopleCreateController::class);
Route::post('/addemail', PeopleAddEmailController::class);
Route::post('/addphone', PeopleAddPhoneController::class);

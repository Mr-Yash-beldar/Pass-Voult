<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VoultController;
use App\Http\Controllers\EmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//for login verify user
Route::post('login', [AuthController::class, 'login']);


//for registration of user
Route::post('signup', [AuthController::class, 'signup']);

//emailverification route
Route::get('email/verify/{$id}', [EmailController::class, 'sedEmailforOTP']);

//middleware for sanctum
Route::middleware('auth:sanctum')->group(function () {
    //logout user need to check login status using middleware sanctum method
    Route::post('logout', [AuthController::class, 'logout']);

    // voutls routes
    Route::apiResource('voults', VoultController::class);

    //user routes only want to use show update delete not want to get any url parameter for user routes
    Route::get('user', [UserController::class, 'show']);
    Route::put('user', [UserController::class, 'update']);
    Route::delete('user', [UserController::class, 'destroy']);
});




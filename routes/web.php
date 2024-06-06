<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\VerifyUserController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('email/send/{id}', [EmailController::class, 'sendEmailforOTP'])->name('sendEmailforOTP');
Route::get('email/verify', [VerifyUserController::class, 'verifyUser'])->name('verifyUser');






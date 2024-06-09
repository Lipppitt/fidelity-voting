<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register'])
	->middleware('guest');

Route::post('/email/verify', function (Request $request) {
	$request->user()->sendEmailVerificationNotification();
	return response()->json(['message' => 'Verification email has been resent']);
})->middleware('auth:sanctum');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	$request->fulfill();
	return response()->json(['verified' => true, 'message' => 'Email verified!']);
})->middleware('auth:sanctum')->name('verification.verify');

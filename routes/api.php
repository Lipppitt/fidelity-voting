<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\VoteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    $user = $request->user();

	$user->load(['votes' => function ($query) {
		$query->select('id', 'user_id', 'poll_id', 'option_id');
	}]);

	return $user;
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

// Poll routes
Route::get('/latest-poll', [PollController::class, 'latest'])
	->middleware( ['auth:sanctum', 'verified']);

// Vote routes
Route::post('/{poll}/vote', [VoteController::class, 'store'])
	->middleware(['auth:sanctum', 'verified']);

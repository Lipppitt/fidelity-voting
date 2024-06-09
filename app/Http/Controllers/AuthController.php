<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
	{
		$user = User::create([
			'name' => $request->validated('email'),
			'email' => $request->validated('email'),
			'password' => $request->validated('password')
		]);

		// Create an API token for the user
		$token = $user->createToken('auth_token')->plainTextToken;

		event(new Registered($user));

		return response()->json([
			'user' => $user,
			'token' => $token
		], 201);
	}
}

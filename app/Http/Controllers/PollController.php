<?php

namespace App\Http\Controllers;

use App\Models\Poll;

class PollController extends Controller
{
    public function latest(): \Illuminate\Http\JsonResponse
	{
		$latestPoll = Poll::with(['options'])->firstOrFail();

		return response()->json(['poll' => $latestPoll]);
	}
}

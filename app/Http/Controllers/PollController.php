<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PollController extends Controller
{
    public function latest(): \Illuminate\Http\JsonResponse
	{
		$latestPoll = Poll::with(['options'])->firstOrFail();

        $user = Auth::id();
        $cacheKey = 'poll_'.$latestPoll->id.'_user_is_voting_' . $user;
        $userHasPendingVote = !empty(Cache::get($cacheKey));

		return response()->json([
            'poll' => $latestPoll,
            'userHasPendingVote' => $userHasPendingVote
        ]);
	}
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteStoreRequest;
use App\Models\Poll;
use App\Services\LocationService;
use App\Services\VoteService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class VoteController extends Controller
{
	/**
	 * @throws ConnectionException
	 */
	public function store(Poll $poll, VoteStoreRequest $request, VoteService $voteService, LocationService $locationService): \Illuminate\Http\JsonResponse
	{
		$userId = Auth::id();

        $cacheKey = 'poll_'.$poll->id.'_user_is_voting_' . $userId;

        if (Cache::get($cacheKey)) {
            return response()->json(['message' => 'Your previous vote is still being processed.'], 403);
        }

        Cache::put($cacheKey, true); // Cache set indefinitely

		$voteId = $request->validated('vote_id');
		$ipAddress = $request->ip();

		$voteService->vote($poll, $userId, $voteId, $ipAddress, $locationService);

		return response()->json(['success' => true]);
	}
}

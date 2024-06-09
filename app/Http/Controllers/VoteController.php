<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteStoreRequest;
use App\Models\Poll;
use App\Services\LocationService;
use App\Services\VoteService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
	/**
	 * @throws ConnectionException
	 */
	public function store(Poll $poll, VoteStoreRequest $request, VoteService $voteService, LocationService $locationService): \Illuminate\Http\JsonResponse
	{
		$userId = Auth::id();
		$voteId = $request->validated('vote_id');
		$ipAddress = $request->ip();

		$voteService->vote($poll, $userId, $voteId, $ipAddress, $locationService);

		return response()->json(['success' => true, 'message' => 'Thank you. Your vote is being processed.']);
	}
}

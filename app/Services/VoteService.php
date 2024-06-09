<?php
namespace App\Services;

use App\Jobs\StoreVoteJob;
use App\Models\Poll;
use Illuminate\Http\Client\ConnectionException;

class VoteService
{
	/**
	 * @throws ConnectionException
	 */
	public function vote(Poll $poll, int $userId, int $voteId, string $ipAddress, LocationService $locationService): \Illuminate\Foundation\Bus\PendingDispatch
	{
		$votersData = [
			'user_id' => $userId,
			'option_id' => $voteId,
			'ip_address' => $ipAddress,
			'location' 	=> $locationService->getLocationFromIp($ipAddress)
		];

		return StoreVoteJob::dispatch($poll->id, $votersData);
	}
}

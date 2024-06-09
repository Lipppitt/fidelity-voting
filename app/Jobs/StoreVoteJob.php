<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreVoteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected int $pollId;

	protected array $votersData;

    /**
     * Create a new job instance.
     */
    public function __construct(int $pollId, array $votersData)
    {
		$this->pollId = $pollId;
		$this->votersData = $votersData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
		if (isset($this->votersData['user_id'])) {
			$user = User::findOrFail($this->votersData['user_id']);

			Vote::create([
				'user_id' => $user->id,
				'poll_id' => $this->pollId,
				'option_id' => $this->votersData['option_id'],
				'voter_ip' => $this->votersData['ip_address'],
				'voter_location' => $this->votersData['location']
			]);
		}
    }
}

<?php

namespace App\Console\Commands;

use App\Mail\AdminTotalPollScoresEmail;
use App\Models\Poll;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyAdminWithTotalPollScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-admin-with-total-poll-scores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email to the site admin with the total votes for the latest poll';

    /**
     * Execute the console command.
     */
    public function handle(): void
	{
        $latestPoll = Poll::with(['votes.option'])->firstOrFail();

		$totalVotesWithCounts = [];

		foreach ($latestPoll->votes as $vote) {
			$optionId = $vote->option->id;

			// If the option label doesn't exist in $totalVotes array, initialize it to 0
			if (!isset($totalVotes[$optionId])) {
				$totalVotesWithCounts[$optionId] = [
					'label' => $vote->option->label,
					'count' => 0
				];
			}

			// Increment the vote count for the option
			$totalVotesWithCounts[$optionId]['count']++;
		}

		Mail::to('dev@unifysoftware.com')
			->send(new AdminTotalPollScoresEmail($totalVotesWithCounts));
	}
}

<?php

namespace Database\Seeders;

use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Database\Seeder;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$poll = Poll::factory()->create([
			'title' => 'What is your favorite season?',
		]);

		$pollOptions = ['Spring', 'Summer', 'Autumn', 'Winter'];

		foreach ($pollOptions as $option) {
			PollOption::factory()->create([
				'poll_id' => $poll->id,
				'label' => $option,
			]);
		}
    }
}

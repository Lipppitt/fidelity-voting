<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminTotalPollScoresEmail extends Mailable
{
    use Queueable, SerializesModels;

	protected array $pollVotes = [];

    /**
     * Create a new message instance.
     */
    public function __construct(array $totalPollVotes)
    {
        $this->pollVotes = $totalPollVotes;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin Total Poll Scores Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
		return new Content(
			view: 'mail.html.poll_total_votes',
			with: [
				'pollVotes' => $this->pollVotes
			],
		);
    }
}

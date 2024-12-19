<?php

namespace App\Mail\ExtraTime;

use App\Models\ExtraTime;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendNewExtraTimeToTeam extends Mailable
{
    use Queueable, SerializesModels;

    public ExtraTime $extra_time;
    public $role;
    public $userID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ExtraTime $extra_time, $role, $userID)
    {
        $this->extra_time = $extra_time;
        $this->role = $role;
        $this->userID = $userID;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Extra Time Requested, task #' . $this->extra_time->task_id,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.extra-time.new-data',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}

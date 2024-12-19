<?php

namespace App\Mail\Leave;

use App\Models\Leave;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendNewLeaveToTeam extends Mailable
{
    use Queueable, SerializesModels;

    public Leave $leave;
    public $role;
    public $userID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Leave $leave, $role, $userID)
    {
        $this->leave = $leave;
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
            subject: 'Leave Requested, task #' . $this->leave->task_id,
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
            view: 'email.leave.new-data',
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

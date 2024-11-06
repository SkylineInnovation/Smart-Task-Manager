<?php

namespace App\Mail\DailyTask;

use App\Models\DailyTask;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendNewDailyTaskToTeam extends Mailable
{
    use Queueable, SerializesModels;

    public DailyTask $daily_task;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(DailyTask $daily_task)
    {
        $this->daily_task = $daily_task;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New Daily Task, task #' . $this->daily_task->id,
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
            view: 'email.daily-task.new-data',
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

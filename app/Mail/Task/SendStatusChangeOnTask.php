<?php

namespace App\Mail\Task;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendStatusChangeOnTask extends Mailable
{
    use Queueable, SerializesModels;

    public $template = '';

    public $task;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template, $task = null)
    {
        $this->template = $template;

        if ($task)
            $this->task = $task;
    }
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $subject = '';

        if ($this->template == 'active')
            $subject = 'Task Started';
        elseif ($this->template == 'manual-finished')
            $subject = 'Task Finished By Employee';
        elseif ($this->template == 'auto-finish')
            $subject = 'Task Finished By System';


        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $view = '';

        if ($this->template == 'active')
            $view = 'employee-start-task';
        elseif ($this->template == 'manual-finished')
            $view = 'employee-manual-finished';
        elseif ($this->template == 'auto-finish')
            $view = 'employee-auto-finish';

        return new Content(
            view: 'stander.email.task.' . $view,
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

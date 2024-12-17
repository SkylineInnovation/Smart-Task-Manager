<?php

namespace App\Mail\Exchange;

use App\Models\ExchangePermission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// we send this mail to owner
// once the emoployee add new request

// content
// amount
// file link
class NewExchangeRequest extends Mailable
{
    use Queueable, SerializesModels;

    public ExchangePermission $exchangePermission;
    public $role;
    public $userID = 0;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ExchangePermission $exchangePermission, $role, $userID = 0)
    {
        $this->exchangePermission = $exchangePermission;
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
            subject: 'New Exchange Request',
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
            view: 'email.exchange-permissions.exchange-permission',
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

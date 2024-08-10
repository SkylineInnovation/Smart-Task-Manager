<?php

namespace App\Mail;

use App\Models\PasswordCode;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendForgetPasswordCode extends Mailable
{
    public $user;
    public $passwordCode;
    public $ip;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $ip)
    {
        $this->user = $user;

        $this->passwordCode = PasswordCode::create([
            'user_id' => $this->user->id,
            'code' => random_int(100000, 999999),
            'note' => 'user forget password from app',
            'is_used' => false,
            'ip_address' => $ip,
        ]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Forget Password Code',
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
            view: 'stander.email.password-code',
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

<?php

namespace App\Jobs;

use App\Mail\Attachment\SendNewAttachmentToTeam;
use App\Models\Attachment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewAttachment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Attachment $attachment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $owners = User::whereRoleIs('owner')->pluck('email')->toArray();

        if (env('SEND_MAIL', false))
            Mail::to($owners)->send(new SendNewAttachmentToTeam($this->attachment));

        if (env('SEND_MAIL', false))
            Mail::to(
                $this->attachment->task->manager->email
            )->send(new SendNewAttachmentToTeam($this->attachment));

        if (env('SEND_MAIL', false))
            Mail::to(
                $this->attachment->task->employees->pluck('email')->toArray()
            )->send(new SendNewAttachmentToTeam($this->attachment));
    }
}

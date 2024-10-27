<?php

namespace App\Jobs;

use App\Mail\Comment\SendNewCommentToTeam;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Comment $comment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $owners = User::whereRoleIs('owner')->pluck('email')->toArray();
        Mail::to($owners)->send(new SendNewCommentToTeam($this->comment));

        Mail::to(
            $this->comment->task->manager->email
        )->send(new SendNewCommentToTeam($this->comment));

        if ($this->comment->main_comment)
            Mail::to(
                $this->comment->main_comment->user->email
            )->send(new SendNewCommentToTeam($this->comment));

        // Mail::to(
        //     $this->comment->task->employees->pluck('email')->toArray()
        // )->send(new SendNewCommentToTeam($this->comment));
    }
}

<?php

namespace App\Jobs;

use App\Mail\ExtraTime\SendNewExtraTimeToTeam;
use App\Models\ExtraTime;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewExtraTime implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public ExtraTime $extra_time;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ExtraTime $extra_time)
    {
        $this->extra_time = $extra_time;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $owners = User::whereRoleIs('owner')->pluck('email')->toArray();
        Mail::to($owners)->send(new SendNewExtraTimeToTeam($this->extra_time));

        Mail::to(
            $this->extra_time->task->manager->email
        )->send(new SendNewExtraTimeToTeam($this->extra_time));

        // Mail::to(
        //     $this->extra_time->task->employees->pluck('email')->toArray()
        // )->send(new SendNewExtraTimeToTeam($this->extra_time));
    }
}

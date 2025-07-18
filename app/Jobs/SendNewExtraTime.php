<?php

namespace App\Jobs;

use App\Mail\ExtraTime\SendNewExtraTimeToTeam;
use App\Models\ExtraTime;
use App\Models\User;
use Illuminate\Bus\Queueable;
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

        if (env('SEND_MAIL', false))
            Mail::to($owners)->send(new SendNewExtraTimeToTeam($this->extra_time, 'owner', 0));

        if (env('SEND_MAIL', false)) {
            if ($this->extra_time->task) {
                Mail::to(
                    $this->extra_time->task->manager->email
                )->send(new SendNewExtraTimeToTeam($this->extra_time, 'manager', $this->extra_time->task->manager->id));
            } else {
                foreach ($this->extra_time->user->managers as $manager) {
                    Mail::to(
                        $manager->email
                    )->send(new SendNewExtraTimeToTeam($this->extra_time, 'manager', $this->extra_time->task->manager->id));
                }
            }
        }
    }
}

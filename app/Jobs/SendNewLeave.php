<?php

namespace App\Jobs;

use App\Mail\Leave\SendNewLeaveToTeam;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewLeave implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Leave $leave;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Leave $leave)
    {
        $this->leave = $leave;
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
            Mail::to($owners)->send(new SendNewLeaveToTeam($this->leave, 'owner', 0));

        if (env('SEND_MAIL', false)) {
            if ($this->leave->task) {
                Mail::to(
                    $this->leave->task->manager->email
                )->send(new SendNewLeaveToTeam($this->leave, 'manager', $this->leave->task->manager->id));
            } else {
                foreach ($this->leave->user->managers as $manager) {
                    Mail::to(
                        $manager->email
                    )->send(new SendNewLeaveToTeam($this->leave, 'manager', $manager->manager->id));
                }
            }
        }
    }
}

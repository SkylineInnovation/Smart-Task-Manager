<?php

namespace App\Jobs;

use App\Mail\DailyTask\SendNewDailyTaskToTeam;
use App\Models\DailyTask;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewDailyTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public DailyTask $daily_task;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DailyTask $daily_task)
    {
        $this->daily_task = $daily_task;
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
            Mail::to($owners)->send(new SendNewDailyTaskToTeam($this->daily_task));

        if (env('SEND_MAIL', false))
            Mail::to(
                $this->daily_task->manager->email
            )->send(new SendNewDailyTaskToTeam($this->daily_task));

        if (env('SEND_MAIL', false))
            Mail::to(
                $this->daily_task->employees->pluck('email')->toArray()
            )->send(new SendNewDailyTaskToTeam($this->daily_task));
    }
}

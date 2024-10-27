<?php

namespace App\Console\Commands;

use App\Mail\Task\SendReminderOnTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendUrgentTaskReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:urgent-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Main every day by the urgent task reminder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $date = date('Y-m-d\TH:i', strtotime('+12 Hours'));
        $date = date('Y-m-d\TH:i');

        $tasks = Task::whereNullOrEmptyOrZero('main_task_id')->whereNullOrEmpty('slug');

        $tasks = $tasks->where('priority_level', 'urgent')
            ->whereIn('status', ['pending', 'active',]);

        $tasks = $tasks->where('end_time', '>=', $date)->get();

        $owners = User::whereRoleIs('owner')->pluck('email')->toArray();

        foreach ($tasks as $task) {
            if (env('SEND_MAIL', false)) {
                $employees_mail = $task->employees->pluck('email')->toArray();
                // $task
                if (env('SEND_MAIL', false))
                    Mail::to($owners)->send(new SendReminderOnTask($task));

                if (env('SEND_MAIL', false))
                    Mail::to($employees_mail)->send(new SendReminderOnTask($task));

                if (env('SEND_MAIL', false))
                    Mail::to($task->manager->email)->send(new SendReminderOnTask($task));
            }
        }
    }
}

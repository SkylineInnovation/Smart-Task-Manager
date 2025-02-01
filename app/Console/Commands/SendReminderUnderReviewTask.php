<?php

namespace App\Console\Commands;

use App\Mail\Task\SendUnderReviewReminderMail;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminderUnderReviewTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:under-review';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send mail remainder about the tasks that under review and dont accept/reject them them';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $tasks = Task::whereNullOrEmptyOrZero('main_task_id')
            ->where('status', 'under-review')->get();


        foreach ($tasks as $task) {

            if (env('SEND_MAIL', false)) {
                if ($task->manager && $task->manager->email)
                    Mail::to($task->manager->email)->send(new SendUnderReviewReminderMail($task));
            }
        }
    }
}

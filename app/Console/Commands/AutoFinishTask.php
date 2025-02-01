<?php

namespace App\Console\Commands;

use App\Jobs\SendNewDiscount;
use App\Models\Comment;
use App\Models\Discount;
use App\Models\Task;
use Illuminate\Console\Command;

class AutoFinishTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:auto-finish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'finish tasks automatically once the time end';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = date('Y-m-d\TH:i');

        $tasks = Task::whereNullOrEmptyOrZero('main_task_id')
            ->whereIn('status', ['pending', 'active',])
            ->where('end_time', '<=', $date)->get();

        foreach ($tasks as $task) {
            $task->update([
                'status' => 'auto-finished',
            ]);

            if ($task->is_separate_task) {
                foreach ($task->employees as $employee) {

                    $comments = Comment::where('task_id', $task->id)
                        ->where('user_id', $employee->id)->get();

                    if (count($comments) == 0) {
                        $discount = Discount::create([
                            'task_id' => $task->id,
                            'user_id' => $employee->id,
                            'amount' => $task->discount(),
                            'reason' => 'auto-finish-task',
                        ]);

                        if (env('SEND_MAIL', false))
                            SendNewDiscount::dispatch($discount);
                    }
                }
            } else {
                $comments = Comment::where('task_id', $task->id)->get();

                if (count($comments) == 0) {
                    foreach ($task->employees as $employee)
                        $discount = Discount::create([
                            'task_id' => $task->id,
                            'user_id' => $employee->id,
                            'amount' => $task->discount(),
                            'reason' => 'auto-finish-task',
                        ]);

                    if (env('SEND_MAIL', false))
                        SendNewDiscount::dispatch($discount);
                }
            }
        }

        return Command::SUCCESS;
    }
}

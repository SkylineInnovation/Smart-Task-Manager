<?php

namespace App\Console\Commands;

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
        $date = date('Y-m-d\TH:i:s');

        $tasks = Task::whereIn('status', ['pending', 'active',])
            ->where('end_time', '<=', $date)->get();

        foreach ($tasks as $task) {
            $task->update([
                'status' => 'auto-finished',
            ]);

            foreach ($task->employees as $employee) {
                Discount::create([
                    'task_id' => $task->id,
                    'user_id' => $employee->id,
                    'amount' => $task->discount(),
                    'reason' => 'auto-finish-task',
                ]);
            }
        }

        return Command::SUCCESS;
    }
}

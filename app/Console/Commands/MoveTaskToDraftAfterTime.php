<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class MoveTaskToDraftAfterTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:auto-draft';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'move task automatically to draft after some time of finish the order';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $date = date('Y-m-d\TH:i', strtotime('-12 Hours'));

        $tasks = Task::whereNullOrEmptyOrZero('main_task_id')->whereNullOrEmpty('slug');

        $tasks = $tasks->whereIn('status', ['auto-finished', 'manual-finished',]);

        $tasks = $tasks->where('end_time', '<=', $date)->get();

        foreach ($tasks as $task) {
            $task->update([
                'slug' => 'draft',
            ]);
        }
    }
}

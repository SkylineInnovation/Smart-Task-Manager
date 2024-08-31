<?php

namespace App\Console\Commands;

use App\Models\DailyTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateScheduleDailytask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:task-run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'daily task run when selected repeat time';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $currentTime = date('H:i');

        Log::alert("currentTime --->>> " . json_encode($currentTime));

        $dailyTasks = DailyTask::where('repeat_time', $currentTime)->get();

        Log::alert("dailyTasks --->>> " . json_encode(count($dailyTasks)));

        foreach ($dailyTasks as $taskD) {
            $task = Task::create([
                'add_by' => 0,
                'manager_id' => $taskD->manager_id,
                'title' => $taskD->title,
                'desc' => $taskD->description,
                'start_time' => date('Y-m-d\T') . date('H:i', strtotime($taskD->start_time)),
                'end_time' => date('Y-m-d\T') . date('H:i', strtotime($taskD->end_time)),
                'priority_level' => $taskD->proearty,
                'status' => 'pending',
                'daily_task_id' => $taskD->id,
            ]);


            $selectedEmployees = $taskD->employees->pluck('id');
            $discount = $taskD->discount();

            $task->employees()->syncWithPivotValues($selectedEmployees, ['discount' => $discount]);
        }


        return Command::SUCCESS;
    }
}

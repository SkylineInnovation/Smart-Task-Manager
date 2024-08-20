<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class TaskShow extends Component
{
    public Task $task;

    public $title, $discount, $desc, $start_time, $end_time;
    public $priority_level, $status;

    public $url;
    public function mount($task)
    {
        $this->url = Route::current()->getName();
        $this->task = $task;

        $this->title = $task->title;
        $this->desc = $task->desc;
        $this->discount = $task->discount();
        $this->start_time = $task->start_time;
        $this->end_time = $task->end_time;

        $this->priority_level = $task->priority_level;
        $this->status = $task->status;
    }

    public function updateTask()
    {
        $this->task->update([
            // 'manager_id' => $this->manager_id,
            'title' => $this->title,
            'desc' => $this->desc,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'priority_level' => $this->priority_level,
            // 'status' => $this->status,
            // 'main_task_id' => $this->main_task_id,
        ]);

        if ($this->status != 'draft') {
            $this->task->update([
                'slug' => null,
                'status' => $this->status,
            ]);
        } else {
            $this->task->update(['slug' => $this->status]);
        }
    }

    public function render()
    {
        return view('livewire.task.task-show');
    }
}

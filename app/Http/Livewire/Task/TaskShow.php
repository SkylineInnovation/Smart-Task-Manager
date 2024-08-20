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

    public $employees = [];
    public $selectedEmployees = [];

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

        $this->employees = \App\Models\User::whereRoleIs('employee')->orderBy('first_name')->get();
        $this->selectedEmployees = $task->employees->pluck('id');
    }

    public function rules()
    {
        return [
            // 'manager_id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'priority_level' => 'required',
            'status' => 'required',
            'discount' => 'required',
            // 'main_task_id' => 'required',

            'selectedEmployees' => 'required',
        ];
    }

    protected $messages = [
        'selectedEmployees.required' => 'Please Select Employee',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateTask()
    {
        $validatedData = $this->validate();

        $this->task->update([
            // 'manager_id' => $this->manager_id,
            'title' => $this->title,
            'desc' => $this->desc,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'priority_level' => $this->priority_level,
            'status' => $this->status,
            // 'main_task_id' => $this->main_task_id,
        ]);

        $this->task->employees()->syncWithPivotValues($this->selectedEmployees, ['discount' => $this->discount]);

        session()->flash('message', 'Task Updated Successfully.');
    }

    public function moveDraft()
    {
        if ($this->task->slug = 'draft') {
            $this->task->update(['slug' => null]);
        } else {
            $this->task->update(['slug' => 'draft']);
        }

        session()->flash('message', 'Task Archived Successfully.');

    }

    public function render()
    {
        return view('livewire.task.task-show');
    }
}

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

    public $employees;
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
        if ($this->task->slug == 'draft') {
            $this->task->update(['slug' => null]);
            session()->flash('message', 'Task Un Archived Successfully.');
        } else {
            $this->task->update(['slug' => 'draft']);
            session()->flash('message', 'Task Archived Successfully.');
        }
    }

    public $tab = 1;
    public function changeTab($index)
    {
        $this->tab = $index;
    }

    public function setTask($id)
    {
        $this->tab = 1;
        $task = Task::find($id);

        $this->task_id = $id;
        $this->task = $task;

        $this->employees = $this->task->employees;
        $this->selectedEmployees = $this->employees->pluck('id')->toArray();

        $this->sub_task_discount = $this->task->discount();

        // $this->sub_task_start_time  = date('Y-m-d\TH:i');
        // $this->sub_task_end_time  = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        $this->sub_task_start_time  = $task->start_time;
        $this->sub_task_end_time  = $task->end_time;

        $this->leave_time_out = date('Y-m-d\TH:i');
        $this->leave_time_in = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        $this->leave_effect_on_time = false;

        $this->extratime_from_time = date('Y-m-d\TH:i', strtotime($task->end_time));
        $this->extratime_to_time = date('Y-m-d\TH:i', strtotime($task->end_time . ' +1 Hours'));
    }

    public function render()
    {
        return view('livewire.task.task-show');
    }
}

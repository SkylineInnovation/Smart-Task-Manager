<?php

namespace App\Http\Livewire\Web;

use App\Http\Controllers\HomeController;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class WebGetTaskByStatus extends Component
{
    use WithFileUploads;

    public $status;

    public $admin_view_status = '', $by, $url;
    public function mount($status, $admin_view_status = '',)
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->status = $status;
    }

    public $task;
    public $task_id = 0;
    public function setTask($id)
    {
        $this->tab = 1;
        $this->task_id = $id;
        $this->task = Task::find($id);

        $this->employees = $this->task->employees;
        $this->selectedEmployees = $this->employees->pluck('id')->toArray();

        $this->sub_task_discount = $this->task->discount();

        $this->sub_task_start_time  = null;
        $this->sub_task_end_time  = null;
    }

    public function rules()
    {
        return [
            // 'manager_id' => 'required',
            'sub_task_title' => 'required',
            'sub_task_desc' => 'required',
            'sub_task_start_time' => 'required',
            'sub_task_end_time' => 'required',
            'sub_task_priority_level' => 'required',
            'sub_task_status' => 'required',
            'sub_task_discount' => 'required',
            // 'main_task_id' => 'required',

            // 'selectedEmployees' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'selectedEmployees.required' => 'Please Select Employee',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function startWithTask()
    {
        $this->task->update(['status' => 'active']);
    }

    public function finishWithTask()
    {
        $this->task->update(['status' => 'manual-finished']);
    }

    public $attatchment_file, $attatchment_title, $attatchment_desc;
    public function addAttatchment()
    {
        Attachment::create([
            'add_by' => $this->by->id,

            'user_id' => $this->by->id,
            'task_id' => $this->task_id,
            'title' => $this->attatchment_title,
            'desc' => $this->attatchment_desc,
            'file' => HomeController::saveImageWeb($this->attatchment_file, 'attachment'),
        ]);

        $this->attatchment_title = '';
        $this->attatchment_desc = '';
        $this->attatchment_file = null;
    }


    public $comment_title, $comment_desc;
    public function addComment()
    {
        Comment::create([
            'add_by' => $this->by->id,

            'task_id' => $this->task_id,
            'user_id' => $this->by->id,
            'title' => $this->comment_title,
            'desc' => $this->comment_desc,
            // 'replay_time' => $this->replay_time,
            // 'main_comment_id' => $this->main_comment_id,
        ]);

        $this->comment_title = '';
        $this->comment_desc = '';
    }

    public $employees;
    public $selectedEmployees;

    public $sub_task_discount;
    public $sub_task_title, $sub_task_desc,
        $sub_task_start_time, $sub_task_end_time,
        $sub_task_priority_level = 'low', $sub_task_status = 'pending';
    public function addSubTask()
    {
        $validatedData = $this->validate();

        $task = Task::create([
            'add_by' => $this->by->id,

            'manager_id' => $this->by->id,
            'title' => $this->sub_task_title,
            'desc' => $this->sub_task_desc,
            'start_time' => $this->sub_task_start_time,
            'end_time' => $this->sub_task_end_time,
            'priority_level' => $this->sub_task_priority_level,
            'status' => $this->sub_task_status,
            'main_task_id' => $this->task_id,
        ]);

        $task->employees()->syncWithPivotValues($this->selectedEmployees, ['discount' => $this->sub_task_discount]);

        // Mail::to(
        //     $task->employees->pluck('email')->toArray()
        // )->send(new SendNewTaskToEmployee($task));

        $this->sub_task_title = null;
        $this->sub_task_desc = null;

        $this->sub_task_start_time  = null;
        $this->sub_task_end_time  = null;

        $this->sub_task_priority_level = 'low';

        $this->selectedEmployees = [];

        $this->task = Task::find($this->task->id);

        $this->sub_task_discount = $this->task->discount();

        session()->flash('sub-task-message', 'Sub Task Created Successfully.');
    }

    public $select_emp;
    public function updatedSelectEmp($val)
    {
        $this->selectedEmployees[] = $val;
    }


    public $tab = 1;
    public function changeTab($index)
    {
        $this->tab = $index;
    }

    public function render()
    {
        $tasks = Task::whereNullOrEmptyOrZero('main_task_id')
            ->where('status', $this->status);

        $tasks = $tasks->orderBy('id', 'desc')
            ->get();

        return view('livewire.web.web-get-task-by-status', compact('tasks'));
    }
}

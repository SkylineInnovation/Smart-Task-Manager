<?php

namespace App\Http\Livewire\Task;

use App\Http\Controllers\HomeController;
use App\Jobs\SendNewAttachment;
use App\Jobs\SendNewTask;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Livewire\WithFileUploads;

class TaskShow extends Component
{
    use WithFileUploads;

    public Task $task;

    public $task_id, $title, $discount, $desc, $start_time, $end_time;
    public $priority_level, $status;

    public $employees;
    public $selectedEmployees = [];


    public $url, $by, $user;
    public function mount($task)
    {
        $this->url = Route::current()->getName();
        $this->task = $task;
        $this->task_id = $task->id;

        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

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

    public $attatchment_file, $attatchment_title, $attatchment_desc;
    public function addAttatchment()
    {
        $attachment = Attachment::create([
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

        $this->task = Task::find($this->task_id);

        // if (env('SEND_MAIL', false))
        SendNewAttachment::dispatch($attachment);
    }

    public function deleteAttatchment($id)
    {
        $attche = Attachment::find($id);
        $attche->delete();

        $this->task = Task::find($this->task_id);
    }

    public $comment_title, $comment_desc;
    public function addComment()
    {
        $validatedData = $this->validate([
            'comment_desc' => 'required|min:60',
        ]);

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
        $this->task = Task::find($this->task_id);
    }

    public $comment_id, $replay_comment_title, $replay_comment_desc;

    public function setCommentId($id)
    {
        $this->comment_id = $id;
    }
    public function replayComment()
    {
        Comment::create([
            'add_by' => $this->by->id,

            'task_id' => $this->task_id,
            'user_id' => $this->by->id,
            'title' => $this->replay_comment_title,
            'desc' => $this->replay_comment_desc,
            // 'replay_time' => $this->replay_time,
            'main_comment_id' => $this->comment_id,
        ]);

        $this->replay_comment_title = '';
        $this->replay_comment_desc = '';

        $this->task = Task::find($this->task_id);

        $this->emit('close-replay-comment-model', $this->task_id);
    }


    public $sub_task_discount;
    public $sub_task_title, $sub_task_desc,
        $sub_task_start_time, $sub_task_end_time,
        $sub_task_priority_level = 'low', $sub_task_status = 'pending';

    public $selected_employe_task = [];

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

        $this->sub_task_title = null;
        $this->sub_task_desc = null;

        $this->sub_task_start_time  = date('Y-m-d\TH:i', strtotime($this->sub_task_end_time));
        $this->sub_task_end_time  = date('Y-m-d\TH:i', strtotime($this->sub_task_start_time . ' +1 Hours'));

        $this->sub_task_priority_level = 'low';

        // $this->selectedEmployees = [];

        $this->task = Task::find($this->task->id);

        $this->sub_task_discount = $this->task->discount();

        session()->flash('sub-task-message', 'Sub Task Created Successfully.');

        if (env('SEND_MAIL', false))
            SendNewTask::dispatchAfterResponse($task);
    }

    public function render()
    {
        return view('livewire.task.task-show');
    }
}

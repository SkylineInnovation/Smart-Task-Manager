<?php

namespace App\Http\Livewire\Web;

use App\Http\Controllers\HomeController;
use App\Mail\Task\SendNewTaskToEmployee;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\ExtraTime;
use App\Models\Leave;
use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

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

        $this->sub_task_start_time  = date('Y-m-d\TH:i');
        $this->sub_task_end_time  = date('Y-m-d\TH:i', strtotime('+1 Hours'));

        $this->leave_time_out = date('Y-m-d\TH:i');
        $this->leave_time_in = date('Y-m-d\TH:i', strtotime('+1 Hours'));

        $this->extratime_from_time = date('Y-m-d\TH:i');
        $this->extratime_to_time = date('Y-m-d\TH:i', strtotime('+1 Hours'));
    }

    public $task;
    public $task_id = 0;
    public function setTask($id)
    {
        $this->tab = 1;
        $task = Task::find($id);

        $this->task_id = $id;
        $this->task = $task;

        $this->employees = $this->task->employees;
        $this->selectedEmployees = $this->employees->pluck('id')->toArray();

        $this->sub_task_discount = $this->task->discount();

        $this->sub_task_start_time  = date('Y-m-d\TH:i');
        $this->sub_task_end_time  = date('Y-m-d\TH:i', strtotime('+1 Hours'));

        $this->leave_time_out = date('Y-m-d\TH:i');
        $this->leave_time_in = date('Y-m-d\TH:i', strtotime('+1 Hours'));

        $this->extratime_from_time = date('Y-m-d\TH:i', strtotime($task->end_time));
        $this->extratime_to_time = date('Y-m-d\TH:i', strtotime($task->end_time . ' +1 Hours'));
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

    public function startWithTask($id)
    {
        $task = Task::find($id);
        $task->update(['status' => 'active']);

        $this->emit('render-active'); // Close model to using to jquery
    }

    public function finishWithTask($id)
    {
        $task = Task::find($id);
        $task->update(['status' => 'manual-finished']);

        $this->emit('render-manual-finished'); // Close model to using to jquery
    }

    public function draftTask($id)
    {
        $task = Task::find($id);
        $task->update(['status' => 'draft']);

        $this->emit('render-manual-finished'); // Close model to using to jquery
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

        // if (env('SEND_MAIL', false))
        //     Mail::to(
        //         $task->employees->pluck('email')->toArray()
        //     )->send(new SendNewTaskToEmployee($task));

        $this->sub_task_title = null;
        $this->sub_task_desc = null;

        $this->sub_task_start_time  = date('Y-m-d\TH:i');
        $this->sub_task_end_time  = date('Y-m-d\TH:i', strtotime('+1 Hours'));

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

    public function deleteTask($id)

    {
        $task = Task::find($id);
        $task->delete();
    }

    public function deleteComents($id)
    {
        $comments = Comment::find($id);
        $comments->delete();
    }

    public function deleteAttatchment($id)
    {
        $attche = Attachment::find($id);
        $attche->delete();
    }

    public function deletecomment($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
    }

    protected $listeners = [
        'refreshRender' => 'render'
    ];

    // 
    public $leave_type = 'leave', $leave_time_out, $leave_time_in, $leave_reason, $leave_result;
    public function addLeaveRequest()
    {
        Leave::create([
            'add_by' => $this->by->id,

            'task_id' => $this->task_id,
            'user_id' => $this->by->id,
            'type' => $this->leave_type,
            'time_out' => $this->leave_time_out,
            'time_in' => $this->leave_time_in,
            'reason' => $this->leave_reason,
            'result' => $this->leave_result,
            'status' => 'pending',
            // 'accepted_by_user_id' => $this->accepted_by_user_id,
            // 'accepted_time' => $this->accepted_time,
        ]);

        $this->emit('close-leave-request-model', $this->task_id); // Close model to using to jquery
    }

    public $extratime_from_time, $extratime_to_time, $extratime_reason;
    public function addExtraTime()
    {

        $from_date = Carbon::parse(date('Y-m-d H:i:s', strtotime($this->extratime_from_time)));
        $to_date = Carbon::parse(date('Y-m-d H:i:s', strtotime($this->extratime_to_time)));

        $dur = $from_date->diff($to_date);

        ExtraTime::create([
            'add_by' => $this->by->id,

            'task_id' => $this->task_id,
            'user_id' => $this->by->id,
            'from_time' => $this->extratime_from_time,
            'to_time' => $this->extratime_to_time,
            'reason' => $this->extratime_reason,
            'status' => 'pending',

            // 'accepted_by_user_id' => $this->accepted_by_user_id,

            'request_time' => date('Y-m-d H:i A'),

            // 'response_time' => $this->response_time,
            'duration' => $dur->format("%d day %h:%i%s"),
        ]);

        $this->extratime_from_time = '';
        $this->extratime_to_time = '';
        $this->extratime_reason = '';

        $this->emit('close-extra-time-model', $this->task_id); // Close model to using to jquery

    }


    public function render()
    {
        $tasks = Task::whereNullOrEmptyOrZero('main_task_id')
            ->where('status', $this->status);

        if ($this->user->hasRole('employee')) {
            $tasks = $tasks->whereHas('employees', function ($q) {
                $q->where('user_id', $this->user->id);
            });
        }

        $tasks = $tasks->orderBy('id', 'desc')->get();

        return view('livewire.web.web-get-task-by-status', compact('tasks'));
    }
}

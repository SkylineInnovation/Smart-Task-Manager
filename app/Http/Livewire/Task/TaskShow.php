<?php

namespace App\Http\Livewire\Task;

use App\Http\Controllers\HomeController;
use App\Jobs\SendNewAttachment;
use App\Jobs\SendNewComment;
use App\Jobs\SendNewTask;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\ExtraTime;
use App\Models\Leave;
use App\Models\Task;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Livewire\WithFileUploads;

class TaskShow extends Component
{
    use WithFileUploads;

    public Task $task;

    public $task_id, $title, $discount, $max_worning_discount, $desc, $start_time, $end_time;
    public $is_separate_task = 0, $comment_type = 'daily', $max_worning_count, $priority_level, $status, $sent_warnings, $close_attempt;

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
        $this->max_worning_discount = $task->max_worning_discount();
        $this->start_time = $task->start_time;
        $this->end_time = $task->end_time;

        $this->is_separate_task = $task->is_separate_task;
        $this->comment_type = $task->comment_type;
        $this->max_worning_count = $task->max_worning_count;
        $this->sent_warnings = $task->sent_warnings;
        $this->close_attempt = $task->close_attempt;
        $this->priority_level = $task->priority_level;
        $this->status = $task->status;

        $this->employees = \App\Models\User::whereRoleIs('employee')->orderBy('first_name')->get();
        $this->selectedEmployees = $task->employees->pluck('id');

        //

        $this->tab = 1;

        // $this->employees = $this->task->employees;
        $this->selectedEmployees = $this->employees->pluck('id')->toArray();

        $this->sub_task_discount = $this->task->discount();
        $this->sub_task_max_worning_discount = $this->task->max_worning_discount();

        $this->sub_task_start_time  = date('Y-m-d\TH:i');
        $this->sub_task_end_time  = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        $this->is_separate_task  = $task->is_separate_task;
        $this->comment_type  = $task->comment_type;
        $this->max_worning_count  = $task->max_worning_count;
        $this->sent_warnings  = $task->sent_warnings;
        $this->close_attempt  = $task->close_attempt;

        // $this->sub_task_start_time  = $task->start_time;
        // $this->sub_task_end_time  = $task->end_time;

        $this->leave_time_out = date('Y-m-d\TH:i');
        $this->leave_time_in = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        $this->leave_effect_on_time = false;

        $this->extratime_from_time = date('Y-m-d\TH:i', strtotime($task->end_time));
        $this->extratime_to_time = date('Y-m-d\TH:i', strtotime($task->end_time . ' +1 Hours'));
    }

    public function rules()
    {
        return [
            // 'manager_id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            // 'start_time' => 'required|date',
            'start_time' => 'required|date|after:' . date('Y-m-d\TH:i', strtotime('-5 Minutes')),
            'end_time' => 'required|date|after:start_time', // _or_equal
            'is_separate_task' => 'required',
            'comment_type' => 'required',
            'max_worning_count' => 'required',
            // 'sent_warnings' => 'required',
            // 'close_attempt' => 'required',
            'priority_level' => 'required',
            'status' => 'required',
            'discount' => 'required',
            'max_worning_discount' => 'required',
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

        if (in_array($this->task->status, ['auto-finished', 'manual-finished'])) {
            session()->flash('message', __('global.task-cant-be-updated'));
            $this->emit('show-message', ['message' => __('global.task-cant-be-updated')]); // show toster message
            return;
        }

        $this->task->update([
            // 'manager_id' => $this->manager_id,
            'title' => $this->title,
            'desc' => $this->desc,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'is_separate_task' => $this->is_separate_task,
            'comment_type' => $this->comment_type,
            'max_worning_count' => $this->max_worning_count,
            // 'sent_warnings' => $this->sent_warnings,
            // 'close_attempt' => $this->close_attempt,
            'priority_level' => $this->priority_level,
            'status' => $this->status,
            // 'main_task_id' => $this->main_task_id,
        ]);

        $this->task->employees()->syncWithPivotValues($this->selectedEmployees, [
            'discount' => $this->discount,
            'max_worning_discount' => $this->max_worning_discount
        ]);

        session()->flash('message', __('global.updated-successfully'));
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.updated-successfully')]); // show toster message
    }

    public function moveDraft()
    {
        if ($this->task->slug == 'draft') {
            $this->task->update(['slug' => null]);
            session()->flash('message', __('global.task-unarchived-successfully'));
            $this->emit('show-message', ['message' => __('global.task-unarchived-successfully')]); // show toster message
        } else {
            $this->task->update(['slug' => 'draft']);
            session()->flash('message', __('global.task-archived-successfully'));
            $this->emit('show-message', ['message' => __('global.task-archived-successfully')]); // show toster message
        }
    }

    public $tab = 1;
    public function changeTab($index)
    {
        $this->tab = $index;
    }

    // public function setTask($id)
    // {
    //     $this->tab = 1;
    //     $task = Task::find($id);

    //     $this->task_id = $id;
    //     $this->task = $task;

    //     $this->employees = $this->task->employees;
    //     $this->selectedEmployees = $this->employees->pluck('id')->toArray();

    //     $this->sub_task_discount = $this->task->discount();

    //     $this->sub_task_start_time  = date('Y-m-d\TH:i');
    //     $this->sub_task_end_time  = date('Y-m-d\TH:i', strtotime('+1 Hours'));
    //     $this->is_separate_task  = $task->is_separate_task;
    //     $this->comment_type  = $task->comment_type;
    //     $this->max_worning_count  = $task->max_worning_count;

    //     // $this->sub_task_start_time  = $task->start_time;
    //     // $this->sub_task_end_time  = $task->end_time;

    //     $this->leave_time_out = date('Y-m-d\TH:i');
    //     $this->leave_time_in = date('Y-m-d\TH:i', strtotime('+1 Hours'));
    //     $this->leave_effect_on_time = false;

    //     $this->extratime_from_time = date('Y-m-d\TH:i', strtotime($task->end_time));
    //     $this->extratime_to_time = date('Y-m-d\TH:i', strtotime($task->end_time . ' +1 Hours'));
    // }

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

        if (env('SEND_MAIL', false))
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
        if ($this->user->hasRole('employee')) {
            $validatedData = $this->validate([
                'comment_desc' => 'required|min:60',
            ]);
        }

        $comment = Comment::create([
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

        if (env('SEND_MAIL', false))
            SendNewComment::dispatch($comment);
    }

    public $comment_id, $replay_comment_title, $replay_comment_desc;

    public function setCommentId($id)
    {
        $this->comment_id = $id;
    }

    public function replayComment()
    {
        $comment = Comment::create([
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

        if (env('SEND_MAIL', false))
            SendNewComment::dispatch($comment);
    }


    public $sub_task_discount, $sub_task_max_worning_discount;
    public $sub_task_title, $sub_task_desc,
        $sub_task_start_time, $sub_task_end_time,
        $sub_task_is_separate_task = 0,
        $sub_task_comment_type = 'daily', $sub_task_max_worning_count,
        $sub_task_priority_level = 'low', $sub_task_status = 'pending', $sub_task_sent_warnings, $sub_task_close_attempt;

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
            'is_separate_task' => $this->sub_task_is_separate_task,
            'comment_type' => $this->sub_task_comment_type,
            'max_worning_count' => $this->sub_task_max_worning_count,
            'sent_warnings' => $this->sub_task_sent_warnings,
            'close_attempt' => $this->sub_task_close_attempt,
            'priority_level' => $this->sub_task_priority_level,
            'status' => $this->sub_task_status,
            'main_task_id' => $this->task_id,
        ]);

        $task->employees()->syncWithPivotValues($this->selectedEmployees, [
            'discount' => $this->sub_task_discount,
            'max_worning_discount' => $this->max_worning_discount
        ]);

        if (env('SEND_MAIL', false))
            SendNewTask::dispatch($task);

        $this->sub_task_title = null;
        $this->sub_task_desc = null;

        $this->sub_task_start_time  = date('Y-m-d\TH:i', strtotime($this->sub_task_end_time));
        $this->sub_task_end_time  = date('Y-m-d\TH:i', strtotime($this->sub_task_start_time . ' +1 Hours'));

        $this->sub_task_is_separate_task = 0;
        $this->sub_task_comment_type = 'daily';
        $this->sub_task_max_worning_count = null;
        $this->sub_task_priority_level = 'low';
        $this->sub_task_sent_warnings = null;
        $this->sub_task_close_attempt = null;

        // $this->selectedEmployees = [];

        $this->task = Task::find($this->task->id);

        $this->sub_task_discount = $this->task->discount();
        $this->sub_task_max_worning_discount = $this->task->max_worning_discount();

        session()->flash('sub-task-message', 'Sub Task Created Successfully.');
    }

    public $extratime, $extratime_id;
    public function setExtraTime($id)
    {
        $this->extratime_id = $id;

        $extratime = ExtraTime::find($id);
        $this->extratime = $extratime;

        $this->extratime_from_time = $extratime->from_time;
        $this->extratime_to_time = $extratime->to_time;
        $this->extratime_reason = $extratime->reason;

        $this->cal_extratime_duration();

        $this->show_extratime = true;
    }

    public function rejectExtraTime($id)
    {
        $extratime = ExtraTime::find($id);

        $extratime->update([
            'response_time' => date('Y-m-d h:i A'),
            'status' => 'rejected',
        ]);
    }

    // // // //
    public $leave, $leave_id;
    public function setLeave($id)
    {
        $this->leave_id = $id;

        $leave = Leave::find($id);
        $this->leave = $leave;

        $this->leave_type = $leave->type;
        $this->leave_time_out = $leave->time_out;
        $this->leave_time_in = $leave->time_in;
        $this->leave_effect_on_time = $leave->effect_on_time;
        $this->leave_reason = $leave->reason;
        $this->leave_result = $leave->result;

        $this->show_leave = true;
    }


    public $show_leave = false;
    public function acceptLeave()
    {
        $leaveTime = Leave::find($this->leave_id);

        $leaveTime->update([
            'type' => $this->leave_type,
            'time_out' => $this->leave_time_out,
            'time_in' => $this->leave_time_in,
            'effect_on_time' => $this->leave_effect_on_time,
            'status' => 'accepted',
            'accepted_by_user_id' => auth()->user()->id,
            'accepted_time' => date('Y-m-d h:i A'),
        ]);

        if ($this->leave_effect_on_time) {
            $task = Task::find($leaveTime->task_id);

            $task->update([
                'end_time' => $this->leave_time_in,
            ]);
        }

        $this->emit('close-accept-leave-model', $this->task_id); // Close model to using to jquery

    }

    public function rejectLeave($id)
    {
        $leaveTime = Leave::find($id);

        $leaveTime->update([
            'response_time' => date('Y-m-d h:i A'),
            'status' => 'rejected',
        ]);
    }

    public function updatedExtratimeFromTime()
    {
        $this->cal_extratime_duration();
    }

    public function updatedExtratimeToTime()
    {
        $this->cal_extratime_duration();
    }

    public function cal_extratime_duration()
    {
        $startDate = Carbon::parse(date('Y-m-d h:i', strtotime($this->extratime_from_time)));
        $endDate = Carbon::parse(date('Y-m-d h:i', strtotime($this->extratime_to_time)));

        $totalSeconds = $endDate->diffInSeconds($startDate);

        // Convert seconds to hours and minutes
        $hours = intval($totalSeconds / 3600);
        $minutes = intval(($totalSeconds % 3600) / 60);
        //
        $hours_string = $hours > 9 ? $hours : '0' . $hours;
        $minutes_string = $minutes > 9 ? $minutes : '0' . $minutes;
        // Format the output
        $result = $hours_string . ':' . $minutes_string . ':00';

        $this->extratime_duration = $result;
    }

    public function render()
    {
        return view('livewire.task.task-show');
    }
}
